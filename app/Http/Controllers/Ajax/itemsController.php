<?php

namespace App\Http\Controllers\Web\Ajax;
use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Repositories\ItemsRepository;
use Illuminate\Http\Request;

class itemsController extends Controller
{
    public ItemsRepository $repository;
    public function __construct(ItemsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(Request $request){
    

        $validation = $this->repository->validation($request);
        if($validation["fails"])
            return JsonResponse::validationErrors($validation["errors"])->initAjaxRequest()->changeCode(200)->changeStatusNumber("S400")->send();
        $this->repository->save($request);

        $message = (new SuccessMessage())->title("Updated Successfully")
            ->body("The items Has Been Updated Successfully");
        Dialog::flashing($message);
        return JsonResponse::success()->send();
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
       

        if($this->repository->delete($request->id))
            return JsonResponse::success()->send();
        else
            return JsonResponse::error()->changeCode(201)->changeStatusNumber('S400')->send();

    }
}
