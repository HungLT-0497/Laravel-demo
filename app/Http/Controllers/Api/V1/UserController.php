<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\CreateOrUpdateUser;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface  $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(){
        try {
            $result = $this->userRepository->findAll();
            return self::successResponse(trans('asset.search_success'), $result);
        } catch (\Exception $exception){
        }
        return self::errorResponse(trans('asset.search_error'));
    }

    public function store(CreateOrUpdateUser $request){
        $request->merge(['password' => bcrypt($request->password)]);
        try {
            $result = $this->userRepository->create($request->all());
            return self::successResponse(trans('asset.create_success'), $result);
        } catch (\Exception $exception){
        }
        return self::errorResponse(trans('asset.create_error'));
    }
    public function update(CreateOrUpdateUser $request, $id){
        if (!empty($request->password))
            $request->merge(['password' => bcrypt($request->password)]);
        try {
            $result = $this->userRepository->update($id, $request->all());
            if (!empty($result))
                return self::successResponse(trans('asset.update_success'), $result);
        } catch (\Exception $exception){
        }
        return self::errorResponse(trans('asset.update_error'));
    }
    public function destroy($id){
        try {
            $result = $this->userRepository->delete($id);
            if ($result)
                return self::successResponse(trans('asset.delete_success'), $result);
        } catch (\Exception $exception){
        }
        return self::errorResponse(trans('asset.delete_error'));
    }
}
