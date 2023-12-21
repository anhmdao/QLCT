<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\WalletRepository;

use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Session\Session;
use DebugBar\DebugBar;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;

use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class CategoriesController extends Controller
{
    //
    use ResponseTrait;

    public CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
//        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->categoryRepository = $categoryRepository;
    }

    public function category(){
        // Get the user ID from the session
        $userIdInSession = session()->get('user_id');

        // Retrieve the user with their associated categories
        $userWithCategories = User::with('categories')->find($userIdInSession);

        // Access the categories from the user model
        $categories = $userWithCategories->categories()->paginate(15); 

        // Pass the categories to the view
        
        return view('pages.category', ['categories' => $categories]);
    }

    public function showForm(){
        return view('pages.add_category');
    }

    public function add_category(Request $request ){
        $userIdInSession = session()->get('user_id');
       // Get the name from the request
        $name = $request->input('name');

        // Check if a category with the same name already exists for the current user
        $existingCategory = Category::where('user_id', $userIdInSession)
            ->where('name', $name)
            ->first();

        if ($existingCategory) {
            // Category with the same name already exists, handle accordingly (e.g., redirect back with an error message)
            return redirect()->route('category')->with('error', 'Danh mục đã tồn tại.');
        }
        
        // Add a new category for the current user
        $category = new Category([
            'user_id' => $userIdInSession,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'color' => $request->input('color'),
        ]);

        // Save the category to the user's categories
        $category->save();
        // echo('<pre>');
        // print_r($category);
        // echo('</pre>');
       
        return redirect()->route('category')->with('success', 'Thêm danh mục mới thành công');
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);

        return view('pages.edit_category', ['category' => $category]);
    }

    public function update(Request $request, $category_id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'status' => 'required|numeric',
        //     'color' => 'required|string',
        // ]);

        $category = Category::find($category_id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'color' => $request->color,
        ]);

        return redirect()->route('category')->with('success', 'Category updated successfully');
    }

    public function delete($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();

        return redirect()->route('category')->with('success', 'Category updated successfully');
    }

    // public function index(): JsonResponse
    // {
    //     try {
    //         $data = $this->categoryRepository->getAll();
    //         return $this->responseSuccess($data, 'Category List Fetch Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function indexAll(Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->categoryRepository->getPaginatedData($request->perPage);
    //         return $this->responseSuccess($data, 'Category List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function search(Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->categoryRepository->searchCategory($request->search, $request->perPage);
    //         return $this->responseSuccess($data, 'Category List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function findByUserId($id, Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->categoryRepository->findByUserId($id, $request->perPage);
    //         return $this->responseSuccess($data, 'Category List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

    //     }
    // }

    // public function findByStatus($status, Request $request): JsonResponse
    // {
    //     try {
    //         $data = $this->categoryRepository->findByStatus($status, $request->perPage);
    //         return $this->responseSuccess($data, 'Category List Fetched Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

    //     }
    // }

    // public function store(Request $request): JsonResponse
    // {
    //     try {
    //         $product = $this->categoryRepository->create($request->all());
    //         return $this->responseSuccess($product, 'New Category Created Successfully !');
    //     } catch (Exception $exception) {
    //         echo "Hello";
    //         return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function show($id): JsonResponse
    // {
    //     try {
    //         $data = $this->categoryRepository->getByID($id);
    //         if (is_null($data)) {
    //             return $this->responseError(null, 'Category Not Found', Response::HTTP_NOT_FOUND);
    //         }

    //         return $this->responseSuccess($data, 'Category Details Fetch Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // // public function update($id, Request $request): JsonResponse
    // // {
    // //     try {
    // //         $data = $this->categoryRepository->update($id, $request->all());
    // //         if (is_null($data))
    // //             return $this->responseError(null, 'Category Not Found', Response::HTTP_NOT_FOUND);

    // //         return $this->responseSuccess($data, 'Category Updated Successfully !');
    // //     } catch (Exception $e) {
    // //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    // //     }
    // // }

    // public function destroy($id): JsonResponse
    // {
    //     try {
    //         $product = $this->categoryRepository->getByID($id);
    //         if (empty($product)) {
    //             return $this->responseError(null, 'Category Not Found', Response::HTTP_NOT_FOUND);
    //         }

    //         $deleted = $this->categoryRepository->delete($id);
    //         if (!$deleted) {
    //             return $this->responseError(null, 'Failed to delete the Category.', Response::HTTP_INTERNAL_SERVER_ERROR);
    //         }

    //         return $this->responseSuccess($product, 'Category Deleted Successfully !');
    //     } catch (Exception $e) {
    //         return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }
}
