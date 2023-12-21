<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Category;
use App\Repositories\MoneyTypeRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use Carbon\Carbon;

use DebugBar\DebugBar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;
use App\Models\Moneytype;
use App\Models\Transaction;
use App\Traits\ResponseTrait;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WalletController extends Controller
{
    //
    use ResponseTrait;

    public WalletRepository $walletRepository;
    public TransactionRepository $transactionRepository;
    public MoneyTypeRepository $moneyTypeRepository;

    public function __construct(WalletRepository $walletRepository, TransactionRepository $transactionRepository, MoneyTypeRepository $moneyTypeRepository)
    {
//        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->walletRepository = $walletRepository;
        $this->transactionRepository = $transactionRepository;
        $this->moneyTypeRepository = $moneyTypeRepository;
    }


    public function wallet(){
        $userIdInSession = session()->get('user_id');

        // Retrieve the user with their associated categories
        $userWithCategories = User::with('wallets')->find($userIdInSession);

        // Access the categories from the user model
        $wallets = $userWithCategories->wallets()->paginate(10); 

        // Pass the categories to the view
        
        return view('pages.wallet', ['wallets' => $wallets]);
    }

    public function add_wallet(Request $request ){
        $userIdInSession = session()->get('user_id');
       
        $money_type_id = ($request->input('money-type') == 'VNĐ') ? 1 : 2;

        //dd($request);
        if($money_type_id == 1 && $request->input('wallet-balance') >= 1000){
            $wallet = new Wallet([
                'user_id' => $userIdInSession,
                'name' => $request->input('wallet-name'),
                'money' => $request->input('wallet-balance'),
                'money_type_id' => $money_type_id,
            ]);

            $wallet->save();

            return redirect()->route('wallet')->with('success', 'Thêm ví mới thành công');
        }else if($money_type_id == 2 && $request->input('wallet-balance') >= 10){
            $wallet = new Wallet([
                'user_id' => $userIdInSession,
                'name' => $request->input('wallet-name'),
                'money' => $request->input('wallet-balance'),
                'money_type_id' => $money_type_id,
            ]);

            $wallet->save();
            return redirect()->route('wallet')->with('success', 'Thêm ví mới thành công');
        }

       return redirect()->route('wallet')->with('error', 'Số dư không đủ, vui lòng thử lại!');
       
       
        
    }

    public function edit($wallet_id)
    {
        $wallet = Wallet::find($wallet_id);

        return view('pages.edit_wallet', ['wallet' => $wallet]);
    }

   // Assuming MoneyType model has a 'rate' column

   public function update(Request $request, $wallet_id)
   {
       $wallet = Wallet::find($wallet_id);
       $new = $request->input('money-type');
   
       if ($new == 'VNĐ') {
           $money_type_id = 1;
           $rate = MoneyType::where('name', $new)->value('rate');
       } else {
           $money_type_id = 2;
           $rate = MoneyType::where('name', $new)->value('rate');
       }
       if ($wallet->money_type_id = $money_type_id){
        return redirect()->route('wallet')->with('error', 'Vui lòng chọn loại tiền khác!');
       }
       if ($wallet->money_type_id != $money_type_id) {
           // Retrieve the user with their associated categories
           $userWithCategories = Wallet::with('transactions')->find($wallet->id);
   
           // Access the transactions from the user model
           $transactions = $userWithCategories->transactions;
   
           // Check if the money types are found
           if ($transactions->isNotEmpty()) {
               // Update the wallet's money
               $wallet->money = ceil($wallet->money * $rate);
   
               // Update the transactions
               foreach ($transactions as $item) {
                   $item->total = ceil($item->total * $rate);
                   $item->save();
               }
           }
       }
   
       $wallet->update([
           'name' => $request->input('wallet-name'),
           'money_type_id' => $money_type_id,
       ]);
   
       return redirect()->route('wallet')->with('success', 'Chỉnh sửa ví thành công!');
   }
   



    public function delete($wallet_id)
    {
        $category = Wallet::find($wallet_id);
        $category->delete();

        return redirect()->route('wallet')->with('success', 'Xoa Vi Thành Công');
    }

    public function show($wallet_id){
        $wallet = Wallet::find($wallet_id);

        return view('pages.add_balance', ['wallet' => $wallet]);
    }
    public function add_balance($wallet_id, Request $request){
         // Get the category ID based on the category name
       
         $category = Category::where('name', 'Nguồn thu')->first();
     
         if (!$category) {
             // Handle the case where the category is not found
             return redirect()->back()->with('error', 'Invalid category selected.');
         }
         if ($request->input('wallet-balance')<0){
            return redirect()->back()->with('error', 'Số dư không hợp lệ!');
         }

        Transaction::create([
            'wallet_id' => $wallet_id,
            'category_id' => $category->id,
            'description' => 'Nguồn thu do người dùng nạp',
            'total' => $request->input('wallet-balance'),
            'time' => Carbon::now()->format('Y-m-d'),
            // Add other fields as needed
        ]);

        $wallet = Wallet::find($wallet_id);
        $wallet->increment('money', $request->input('wallet-balance'));
    
        return redirect()->route('wallet')->with('success', 'Nạp tiền thành công!');
    }

    // public function updateMoneyType($id, Request $newWallet)
    // {
    //         $wallet = Wallet::findById($id);

    //         if ($wallet->money_type_id != $newWallet->money_type_id) {
    //             $newWallet->id = $id;
    //             $transactions = Transaction::findAllByWalletId($wallet->id);
    //             $amount = Moneytype::getByID($wallet->money_type_id)->rate / Moneytype::getByID($newWallet->money_type_id)->rate;
    //             $newWallet->money = ceil($wallet->money * $amount * 100) / 100;

    //         foreach ($transactions as $item) {
    //             $item->total = ceil($item->total * $amount * 100) / 100;
    //             Transaction::update($item->id, $item);
    //         }
    //     }

    //     $wallet = Wallet::update($id, [$newWallet]);
    // }

    // public function updateMoney($id, $new_id){
    //     $wallet = Wallet::findById($id);

    //     if($wallet->money_type_id != $new_id){
    //          // Retrieve the user with their associated categories
    //         $userWithCategories = Wallet::with('transactions')->find($id);

    //         // Access the categories from the user model
    //         $transaction = $userWithCategories->transactions(); 
    //         $amount = Moneytype::getByID($wallet->money_type_id)->rate / Moneytype::getByID($new_id)->rate;
    //         $wallet->update
    //     }
    // }
    // public function index(): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->getAll();
    //         return $this->responseSuccess($data, 'Wallet List Fetch Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function indexAll(Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->getPaginatedData($request->perPage);
    //         return $this->responseSuccess($data, 'Wallet List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function search(Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->searchWallet($request->search, $request->perPage);
    //         return $this->responseSuccess($data, 'Wallet List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function findByUserId($id, Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->findByUserId($id, $request->perPage);
    //         return $this->responseSuccess($data, 'Wallet List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

    //     }
    // }

    // public function findByStatus($id): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->findByStatus($id);
    //         return $this->responseSuccess($data, 'Wallet List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

    //     }
    // }

    // public function store(Request $request): JsonResponse
    // {
    //     try {
    //         $product = $request->all();

    //         $product = $this->walletRepository->create($product);
    //         return $this->responseSuccess($product, 'New Wallet Created Successfully !');
    //     } catch (Exception $exception) {
    //         echo "Hello";
    //         return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function show($id): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->getByID($id);
    //         if (is_null($data)) {
    //             return $this->responseError(null, 'Wallet Not Found', Response::HTTP_NOT_FOUND);
    //         }

    //         return $this->responseSuccess($data, 'Wallet Details Fetch Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    

    // public function updateStatus($id): JsonResponse
    // {
    //     $wallet = $this->walletRepository->findById($id);
    //     if ($wallet == null) {
    //         return $this->responseError(null, 'Wallet Not Found', Response::HTTP_NOT_FOUND);
    //     }
    //     if ($wallet->status == 1) {
    //         $wallet->status = 2;
    //     } else if ($wallet->status == 2) {
    //         $wallet->status = 1;
    //     }
    //     $this->walletRepository->update($id, [$wallet]);
    //     return $this->responseSuccess($wallet, 'Wallet');

    // }

    // public function update($id, Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->walletRepository->update((int)$request->id, [$request->all()]);
    //         $this->walletRepository->turnOffWallet($id);
    //         if (is_null($data))
    //             return $this->responseError(null, 'Wallet Not Found', Response::HTTP_NOT_FOUND);

    //         return $this->responseSuccess($data, 'Wallet Updated Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function destroy($id): JsonResponse
    // {
    //     try {
    //         $wallet = $this->walletRepository->findById($id);
    //         if (empty($wallet)) {
    //             return $this->responseError(null, 'Wallet Not Found', Response::HTTP_NOT_FOUND);
    //         }
    //         return $this->responseSuccess($this->walletRepository->delete($id), 'Wallet Deleted Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
}
