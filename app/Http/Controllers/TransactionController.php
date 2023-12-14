<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\Category;
use App\Repositories\WalletRepository;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;
use App\Models\Wallet;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TransactionController extends Controller
{
    //
    use ResponseTrait;

    public TransactionRepository $transactionRepository;
    public WalletRepository $walletRepository;
    public CategoryRepository $categoryRepository;

    public function __construct(TransactionRepository $transactionRepository, WalletRepository $walletRepository, CategoryRepository $categoryRepository)
    {
//        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->transactionRepository = $transactionRepository;
        $this->walletRepository = $walletRepository;
        $this->categoryRepository = $categoryRepository;
    }

   

    public function transaction()
    {
        $userIdInSession = session()->get('user_id');

        // Retrieve the user with their associated categories and transactions
        $userWithCategoriesAndTransactions = User::with('wallets.transactions.category')->find($userIdInSession);

        // Access the transactions and categories from the user model
        $flatTransactions = $userWithCategoriesAndTransactions->wallets->flatMap->transactions;

        // Paginate the transactions manually
        $perPage = 12;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $flatTransactions->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $transactions = new LengthAwarePaginator($currentItems, $flatTransactions->count(), $perPage, $currentPage);

        // Retrieve all categories for the user
        $categories = Category::where('user_id', $userIdInSession)->get();

        $wallets = Wallet::where('user_id', $userIdInSession)->get();

        // Pass the transactions to the view
        return view('pages.transaction', ['transactions' => $transactions, 'categories' => $categories, 'wallets' => $wallets]);
    }

    public function search(Request $request)
    {
        $userIdInSession = session()->get('user_id');
    
        // Retrieve the user with their associated categories and transactions
        $userWithCategoriesAndTransactions = User::with('wallets.transactions.category')->find($userIdInSession);
    
        // Access the transactions and categories from the user model
        $flatTransactions = $userWithCategoriesAndTransactions->wallets->flatMap->transactions;
    
        // Apply filters based on form input
        $startTime = $request->input('start-time');
        $endTime = $request->input('end-time');
       
        $filteredTransactions = $flatTransactions
            ->where('time', '>=', $startTime)
            ->where('time', '<=', $endTime)
            
            ->all();
    
        // Paginate the filtered transactions manually
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($filteredTransactions, ($currentPage - 1) * $perPage, $perPage);
        $transactions = new LengthAwarePaginator($currentItems, count($filteredTransactions), $perPage, $currentPage);
    
        // Retrieve all categories for the user
        $categories = Category::where('user_id', $userIdInSession)->get();
    
        $wallets = Wallet::where('user_id', $userIdInSession)->get();
    
        // Pass the transactions to the view
        return view('pages.transaction', ['transactions' => $transactions, 'categories' => $categories, 'wallets' => $wallets]);
    }

    public function edit($transaction_id){
        $userIdInSession = session()->get('user_id');
        $transaction = Transaction::find($transaction_id);
        $categories = Category::where('user_id', $userIdInSession)->get();
        $wallets = Wallet::where('user_id', $userIdInSession)->get();

        return view('pages.edit_transaction',  ['transaction' => $transaction, 'categories' => $categories, 'wallets' => $wallets]);
    }

    public function update($transaction_id, Request $request){
        $transaction = Transaction::find($transaction_id);
        $transaction->update([
            'description' => $request->input('transaction-name'),
            'time' => $request->input('transaction-time'),
        ]);

        return redirect()->route('transaction')->with('succees', 'Chỉnh sửa thông tin giao dịch thành công');
    }

// ...

    public function add_transaction(Request $request)
    {
        // Retrieve wallet and category
        $wallet = Wallet::find($request->input('transaction-wallet'));
        $category = Category::find($request->input('transaction-category'));

        // Ensure wallet and category exist
        if (!$wallet || !$category) {
            return redirect()->back()->with('error', 'Invalid wallet or category.');
        }

        // Check if the category is 'Nguồn thu'
        if ($category->name == 'Nguồn thu') {
            // Increment wallet balance for income
            $wallet->money += $request->input('transaction-amount');
        } else {
            // Check if there is enough balance for the spending category
            if ($wallet->money < $request->input('transaction-amount')) {
                return redirect()->back()->with('error', 'Số dư trong ví không đủ để thực hiện giao dịch. Vui lòng thử lại!.');
            }

            // Subtract from wallet balance for spending
            $wallet->money -= $request->input('transaction-amount');
        }

        // Save the updated wallet balance
        $wallet->save();

        // Create a new transaction
        Transaction::create([
            'wallet_id' => $wallet->id,
            'category_id' => $category->id,
            'description' => $request->input('transaction-name'),
            'total' => $request->input('transaction-amount'),
            'time' => $request->input('transaction-time'),
            // Add other fields as needed
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thêm giao dịch mới thành công.');
    }

   

    public function indexChart()
    {
        // Fetch transactions from the database and group by month
        $transactions = Transaction::select(
            DB::raw("DATE_FORMAT(time, '%Y-%m') as month"),
            DB::raw('SUM(CASE WHEN categories.name = "Nguồn thu" THEN total ELSE 0 END) as total_income'),
            DB::raw('SUM(CASE WHEN categories.name != "Nguồn thu" THEN total ELSE 0 END) as total_spending')
        )
        ->join('categories', 'transactions.category_id', '=', 'categories.id')
        ->groupBy('month')
        ->get();

        return response()->json($transactions);
    }

    public function spendingChart()
    {
        $currentMonth = now()->format('Y-m');

        $spendingByCategory = Transaction::join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('name', '!=', 'Nguồn thu') // Update this line with the correct column name
            ->where(DB::raw("DATE_FORMAT(time, '%Y-%m')"), $currentMonth)
            ->groupBy('categories.id', 'categories.name')
            ->select('categories.name as name', DB::raw('SUM(transactions.total) as total'))
            ->get();

        return response()->json($spendingByCategory);
    }





    // public function index(): JsonResponse
    // {
    //     try {
    //         $data = $this->transactionRepository->getAll();
    //         return $this->responseSuccess($data, 'Transaction List Fetch Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function indexAll(Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->transactionRepository->getPaginatedData($request->perPage);
    //         return $this->responseSuccess($data, 'Transaction List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function search(Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->transactionRepository->searchTransaction($request->search, $request->perPage);
    //         return $this->responseSuccess($data, 'Transaction List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function findByWallet($id): JsonResponse
    // {
    //     try {
    //         $data = $this->transactionRepository->findAllByWalletId($id);
    //         return $this->responseSuccess($data, 'Transaction List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function findByCategory($id): JsonResponse
    // {
    //     try {
    //         $data = $this->transactionRepository->findAllByCategoryId($id);
    //         return $this->responseSuccess($data, 'Transaction List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }


    // public function store(Request $request): JsonResponse
    // {
    //     try {
    //         $wallet = $this->walletRepository->findById((int)$request->wallet_id);
    //         $category = $this->categoryRepository->getByID((int)$request->category_id);
    //         $transaction = $this->transactionRepository->create((array)$request->all());
    //         if ($category->status == 1) {
    //             $wallet->money += $request->total;
    //         } else {
    //             $wallet->money -= $request->total;
    //         }
    //         $this->walletRepository->update($wallet->id, [$wallet]);
    //         return $this->responseSuccess($transaction, 'New Transaction Created Successfully !');

    //     } catch (Exception $exception) {
    //         return $this->responseError($this->categoryRepository->getByID((int)$request->category_id), $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function show($id): JsonResponse
    // {
    //     try {
    //         $data = $this->transactionRepository->getByID($id);
    //         if (is_null($data)) {
    //             return $this->responseError(null, 'Transaction Not Found', Response::HTTP_NOT_FOUND);
    //         }

    //         return $this->responseSuccess($data, 'Transaction Details Fetch Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function update($id, Request $request): JsonResponse
    // {
    //     try {
    //         $transaction = $this->transactionRepository->findById($id);
    //         $wallet = $this->walletRepository->findById($transaction->wallet_id);
    //         $oldCategory = $this->categoryRepository->getByID($transaction->category_id);
    //         $newCategory = $this->categoryRepository->getByID($request->category_id);
    //         if ($oldCategory->status == 1) {
    //             $wallet->money -= $transaction->total;
    //         } else {
    //             $wallet->money += $transaction->total;
    //         }
    //         if ($newCategory->status == 1) {
    //             $wallet->money += $request->total;
    //         } else {
    //             $wallet->money -= $request->total;
    //         }
    //         $this->walletRepository->update($wallet->id, [$wallet]);
    //         $this->transactionRepository->update($id, [$request]);
    //         return $this->responseSuccess($newCategory, 'New Transaction Created Successfully !');
    //     } catch (Exception $exception) {
    //         return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function findAllByMonth($id, $status): JsonResponse
    // {
    //     $currentTime = Carbon::now();
    //     $month = $currentTime->toArray()['month'];

    //     return $this->responseSuccess($this->transactionRepository->findAllByMonth($status, $month, $id), 'New Transaction Created Successfully !');

    // }

    // public function findAllTransactionFor6Month($id, $status): JsonResponse
    // {
    //     $days = [0,31,28,31,30,31,30,31,31,30,31,30,31];
    //     $transaction = array();
    //     $currTime = Carbon::now();
    //     $currMonth = date('Y-m', strtotime($currTime->toDateString()));
    //     $startOfMonth = $currMonth.'-01';
    //     $transaction[$currMonth] = $this->transactionRepository->findAllTransactionFor6Month($id, $currMonth.'-01', $currTime->toDateString(), $status);
    //     $startMonth = $currTime->startOfMonth();
    //     $day = '';
    //     for ($i = 1; $i < 7; $i++) {
    //         $monthAgo = date('Y-m', strtotime($startMonth->toDateString() . ' -' . $i . ' month'));
    //         $time = preg_split('/\-/',$monthAgo);
    //         $year = (int)$time[0];
    //         if((int)$time[1]){
    //             if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
    //                 $day = $days[2] + 1;
    //             }
    //         }
    //         $day = $days[(int)$time[1]];
    //         $transaction[$monthAgo] = $this->transactionRepository->findAllTransactionFor6Month($id, $monthAgo.'-01', $monthAgo.'-'.$day, $status);
    //     }
    //     return $this->responseSuccess((object)$transaction, 'Successfully !');

    // }

    // public function findAllByRange(Request $request, $id): JsonResponse
    // {
    //     $startTime = date('Y-m-d', strtotime($request->filled('startTime') ? $request->startTime : '1990-01-01'));
    //     $endTime = date('Y-m-d', strtotime($request->filled('endTime') ? $request->endTime : '3000-01-01'));

    //     return $this->responseSuccess($this->transactionRepository->findByRange($id, $request->status, $startTime, $endTime, $request->from, $request->to), 'Successfully !');

    // }

    // public function destroy($id): JsonResponse
    // {
    //     try {
    //         $transaction = $this->transactionRepository->findById($id);
    //         $wallet = $this->walletRepository->findById($transaction->wallet_id);
    //         $category = $this->categoryRepository->getByID($transaction->category_id);
    //         if ($category->status == 1) {
    //             $wallet->money -= $transaction->total;
    //         } else {
    //             $wallet->money += $transaction->total;
    //         }
    //         $this->walletRepository->update($wallet->id,[$wallet]);
    //         $this->transactionRepository->delete($id);
    //         return $this->responseSuccess($transaction, 'New Transaction Created Successfully !');
    //     } catch (Exception $exception) {
    //         return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
}
