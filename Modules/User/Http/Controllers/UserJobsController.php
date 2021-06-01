<?php

namespace Modules\User\Http\Controllers;

use App\Models\Jobs;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\AdminJobsRequest;
// use Illuminate\Routing\Controller;
class UserJobsController extends Controller
{

    public function index()
    {
        $jobs = Jobs::where('user_id', get_data_user('web'))
            ->paginate(12);

        $viewData = [
            'jobs' => $jobs
        ];
        return view('user::pages.jobs.index', $viewData);
    }
    public function showMessagesSuccess($message = 'Thêm mới thành công')
    {
        return \Session::flash('toastr', [
            'type' => 'success',
            'message' => $message
        ]);
    }
    public function showMessagesError($message = 'Xử lý dữ liệu thất bại')
    {
        return \Session::flash('toastr', [
            'type' => 'error',
            'message' => $message
        ]);
    }
    public function create()
    {
        $countjobs = Jobs::where('user_id', get_data_user('web'))->count();
        if($countjobs < 10){
            return view('user::pages.jobs.addJobs');
        } else {
            return view('user::pages.jobs.contactAdmin');
        }
       
    }
    public function addJobs(AdminJobsRequest $request)
    {
        $data = $request->except(['save', '_token']);
        $data['created_at'] = Carbon::now();
        $data['user_id'] = get_data_user('web');
        $data['status'] = 0;
        $data['is_hot'] = 0;
        $jobsID = Jobs::insertGetId($data);
        if ($jobsID) {
            $this->showMessagesSuccess();
            return  redirect()->route('get_user.jobs');
        }
        $this->showMessagesError();
    }
    public function edit($id)
    {
        $jobedit = Jobs::findOrFail($id);
        return view('user::pages.jobs.editJobs', compact('jobedit'));
    }

    public function update(AdminJobsRequest $request, $id)
    {
        $data = $request->except(['save','_token']);
        $data['updated_at'] = Carbon::now();
        $jobedit = Jobs::findOrFail($id);
        $jobedit->fill($data)->update();
        $this->showMessagesSuccess();
        return redirect()->route('get_user.jobs');
    }
    public function delete(Request $request, $id)
    {
       
        if($request->ajax())
        {
            $job = Jobs::findOrFail($id);
            if ($job)
            {
                $job->delete();
            }
            return response()->json([
                'status' => 200,
                'message' => 'Xoá dữ liệu thành công'
            ]);
        }
        return redirect()->to('/');
    }
}
