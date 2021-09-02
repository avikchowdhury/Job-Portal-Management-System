<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\JobPostRequest;
use App\Models\Job;
use App\Models\Company;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Post;

class JobController extends Controller
{
    public function __construct(){
    $this->middleware(['employer'],['except'=>array('index','show','apply','allJobs','searchJobs','category')]);
}
    public function index(){
      $jobs = Job::latest()->limit(10)->where('status',1)->get(); 
      $categories = Category::with('jobs')->get();
      $posts = Post::where('status',1)->get();
      $companies = Company::get()->random(8);   
      $testimonial = Testimonial::orderBy('id','DESC')->first();   
    	return view('welcome',compact('jobs','companies','categories','testimonial','posts'));
    }
    public function company(){
    	return view('company.index');
    }

    public function show($id,Job $job){
      $jobRecommendations = $this->jobRecommendations($job);

      return view('jobs.show',compact('job','jobRecommendations'));
    }
    public function jobRecommendations($job){
      $data = [];
      
      $jobsBasedOnCategories = Job::latest()->where('category_id',$job->category_id)
                           ->whereDate('last_date','>',date('Y-m-d'))
                           ->where('id','!=',$job->id)
                           ->where('status',1)
                           ->limit(6)
                           ->get();
      array_push($data,$jobsBasedOnCategories);
                         
      $jobBasedOnCompany = Job::latest()
                              ->where('company_id',$job->company_id)
                              ->whereDate('last_date','>',date('Y-m-d'))
                              ->where('id','!=',$job->id)
                              ->where('status',1)
                              ->limit(6)
                              ->get();
          array_push($data,$jobBasedOnCompany);

      $jobBasedOnPosition= Job::where('position','LIKE','%'.$job->position.'%') ->where('id','!=',$job->id)
                              ->where('status',1)
                              ->limit(6);
          array_push($data,$jobBasedOnPosition);

     $collection  = collect($data);
     $unique = $collection->unique("id");
     $jobRecommendations =  $unique->values()->first();
     return $jobRecommendations;
  }
    public function  create(){
      return view('jobs.create');
  }
  public function  store(JobPostRequest $request){
        
    $user_id = auth()->user()->id;
    $company = Company::where('user_id',$user_id)->first();
    $company_id = $company->id;
    Job::create([
        'user_id' => $user_id,
        'company_id' => $company_id,
        'title'=>request('title'),
        'slug' =>Str::slug(request('title')),
        'description'=>request('description'),
        'roles'=>request('roles'),
        'category_id' =>request('category'),
        'position'=>request('position'),
        'address'=>request('address'),
        'type'=>request('type'),
        'status'=>request('status'),
        'last_date'=>request('last_date'),
        'number_of_vacancy'=>request('number_of_vacancy'),
        'gender'=>request('gender'),
        'experience'=>request('experience'),
        'salary'=>request('salary')
     


    ]);
    return redirect()->back()->with('message','Job posted successfully!');
 }
 public function myjob(){
  $jobs = Job::where('user_id',auth()->user()->id)->get();
  return view('jobs.myjob',compact('jobs'));
}
public function edit($id){
  $job = Job::findOrFail($id);
  return view('jobs.edit',compact('job'));
}

public function update(JobPostRequest $request,$id){
  $job = Job::findOrFail($id);
  $job->update($request->all());
  return redirect()->back()->with('message','Job  Sucessfully Updated!');

}
  public function apply(Request $request,$id){
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message','Application sent!');

    } 
    public function applicant(){
      $applicants = Job::has('users')->where('user_id',auth()->user()->id)->get();
      return view('jobs.applicants',compact('applicants'));
  }
  public function destroy(Job $job)
  {
    $job->delete();

    return redirect()->back()->with('message','Job Deleted');
  }
  public function allJobs(Request $request){
       
        $keyword = $request->get('title');
        $type = $request->get('type');
        $category = $request->get('category_id');
        $address = $request->get('address');
        if($keyword||$type||$category||$address){
         $jobs = Job::where('title','LIKE','%'.$keyword.'%')
                 ->orWhere('type',$type)
                 ->orWhere('category_id',$category)
                 ->orWhere('address',$address)
                 ->paginate(20);
                 return view('jobs.alljobs',compact('jobs'));
        }else{
 
             $jobs = Job::latest()->paginate(20);
             return view('jobs.alljobs',compact('jobs'));
             }
   }
      public function searchJobs(Request $request){
       
    $keyword = $request->get('keyword');
    $users = Job::where('title','like','%'.$keyword.'%')
            ->orWhere('position','like','%'.$keyword.'%')
            ->limit(5)->get();
    return response()->json($users);

    }
}


