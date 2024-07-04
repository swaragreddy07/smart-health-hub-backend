<?php
// UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Prescription;
use App\Models\Appointment;
use Exception;

class UserController extends Controller
{
    public function register(Request $request)
{// Validate request data
$request->validate([
    // 'username' => 'required',
    'password' => 'required',
    'email' => 'required|email',
    // 'full_name' => 'required',
    'role_id' => 'required',
]);

// Check if email already exists

$emailExists = User::where('email', $request->email)->exists();

if ($emailExists) {
    return response()->json(['status' => 0, 'message' => 'Email already exists'], 409);
}



// Hash the password
$hashedPassword = Hash::make($request->password);
$dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');

// Create new user
try{
$user = User::create([
    // 'username' => '',
    'password' => $hashedPassword,
    'email' => $request->email,
    'full_name' => $request->firstName.$request->lastName?$request->firstName.$request->lastName:$request->full_name,
    'role_id' => $request->role_id,
    'dob'=>$dob,
    'phoneNumber'=>$request->phoneNumber,
    'gender'=>$request->gender,
    'speciality'=>$request->speciality?$request->speciality:'',
    'activated' => true
]);


return response()->json(['status'=>1,'user' => $user,'message'=>'Registered Successfully'], 201);
}
catch(Exception $e){
    return response()->json(['status' => 0, 'message' => 'User registration failed', "Exception" => $e->getMessage()], 500);
}
}



public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Attempt to authenticate user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Fetch all user details from the database
            // $users = User::all();

            // Create a personal access token for the authenticated user
            $token = $user->createToken('authToken')->plainTextToken;

            // Return the token and user details in the response
            return response()->json(['token' => $token, 'user' => $user,'status'=>1], 200);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Unauthorized','status'=>2], 201);
        }
    }

    public function activateAccount(Request $request)
{
    $userId = $request->input('user_id');

    $user = User::findOrFail($userId);
    $user->activated = true;
    $user->save();

    return response()->json(['message' => 'User account activated successfully'], 200);
}

public function deactivateAccount(Request $request)
{
    $userId = $request->input('user_id');

    $user = User::findOrFail($userId);
    $user->activated = false;
    $user->save();

    return response()->json(['message' => 'User account deactivated successfully'], 200);
}



    public function getAllHealthcareProviders(Request $request)
    {
        $userId=$request->input('user_id');
        $providers = User::where('role_id', 2)->get();

        return response()->json(['providers' => $providers], 200);
    }

    public function getHealthcareProvider(Request $request)
    {
        $userId=$request->input('user_id');

        $provider = User::findOrFail($userId);

        if ($provider->role_id !== 2) {
            return response()->json(['error' => 'User is not a healthcare provider'], 202);
        }

        return response()->json(['provider' => $provider], 200);
    }

    public function updateHealthcareProvider(Request $request)
    {
        $userId=$request->input('user_id');
        $request->validate([
            // 'full_name' => 'required',
            // 'email' => 'required|email|unique:dbt_user,email',
            
        ]);

        $provider = User::findOrFail($userId);
        
        if ($provider->role_id !== 2) {
            return response()->json(['error' => 'User is not a healthcare provider'], 202);
        }

        $provider->update([
            'full_name' => $request->input('full_name')?$request->input('full_name'):$provider->full_name,
            'phoneNumber' => $request->input('phoneNumber')?$request->input('phoneNumber'):$provider->phoneNumber,
            'speciality' => $request->input('speciality'),
        ]);

        return response()->json(['message' => 'Healthcare provider profile updated successfully'], 200);
    }
    public function getAllUsers(Request $request)
    {
        // $userId=$request->input('user_id');
        $providers = User::where('role_id', 1)->get();

        return response()->json(['users' => $providers], 200);
    }
    public function getUserData(Request $request)
{
    $userId=$request->input('user_id');
    $user = User::find($userId);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Fetch appointments and prescriptions for the user
    $appointments = Appointment::where('user_id',$userId)->get();
    $prescriptions = Prescription::where('user_id',$userId)->get();

    return response()->json([
        'user' => $user,
        'appointments' => $appointments,
        'prescriptions' => $prescriptions
    ], 200);
}
public function deleteUser(Request $request)
{
    $userId = $request->input('user_id');

    $user = User::findOrFail($userId);
    $user->delete();

    return response()->json(['message' => 'User deleted successfully'], 200);
}

public function updateUserData(Request $request)
{
    $userId = $request->input('user_id');

    // Validate request data
    $request->validate([
        // 'full_name' => 'required',
        // 'phoneNumber' => 'required|numeric',
    ]);

    // Find the user
    $user = User::findOrFail($userId);

    // Update user's information
    $user->update([
        'full_name' => $request->input('full_name'),
        'phoneNumber' => $request->input('phoneNumber'),
    ]);

    return response()->json(['message' => 'User information updated successfully'], 200);
}
public function deleteHealthcareProviders(Request $request)
{
    $userId = $request->input('user_id');

    $user = User::findOrFail($userId);
    $user->delete();

    return response()->json(['message' => 'User deleted successfully'], 200);
}

public function change(){

    try{
    $collection = collect();

    $count = User::where('role_id', 2)
             ->where('access_level', 1)
             ->count();

    $collection->push($count);

    $count = User::where('role_id', 2)
    ->where('access_level', 0)
    ->count();

   $collection->push($count);

   $count = User::where('role_id', 4)
   ->where('access_level', 1)
   ->count();

  $collection->push($count);

  $count = User::where('role_id', 4)
  ->where('access_level', 0)
  ->count();

  $collection->push($count);
   
  return response()->json(["message"=>$collection]);
    }
    catch(Exception $e){
        return response()->json(["message"=>$e->getMessage()]);
    }
    
}

public function get(Request $request){
  try{
    $request->validate([
        "role_id"=>"required"
    ]);
    $user = User::where('role_id', $request->role_id)->get();
    return response()->json(["message"=>$user]);
  }catch(Exception $e){
    return response()->json(["message"=>$e->getMessage()]);
}
}

public function access(Request $request){
    try{
      $request->validate([
          "user_id"=>"required"
      ]);
      $user = User::find($request->user_id);
      if($user->access_level == true){
        $user->access_level = false;
        $user->save();
      }
    else{
        $user->access_level = true;
        $user->save();
    }
    return response()->json(["message"=>$user]);
    }catch(Exception $e){
      return response()->json(["message"=>$e->getMessage()]);
  }
  }

  public function doctor(Request $request){
    $doctors = User::where('role_id',$request->role_id)->get();
    return response()->json(["message"=>$doctors]);
  }

  
  public function storedoctor(Request $request){
    try {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            return response()->json(["message"=>2]);
        }

        $hashedPassword = Hash::make($request->password);
        $user = User::create([
            // 'username' => '',
            'password' => $hashedPassword,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'role_id' => $request->role_id,
            'dob'=>$request->dob,
            'phoneNumber'=>$request->phoneNumber,
            'gender'=>$request->gender,
            'speciality'=>$request->speciality?$request->speciality:'',
            'activated' => $request->activated,
            'qualification'=> $request->qualification,
            'license_number'=> $request->license_number,
            'city'=>$request->city
        ]);

        return response()->json(["message"=>$user]);
    } catch (Exception $e) {
        return response()->json(['message' => 1, "error"=>$e->getMessage()]);
    }
  }

  public function updatedoctor(Request $request, $id){
    try {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        $user1 = User::where('email', $request->email)->first();
        $user = User::find($id);
       
        if($user!=null && $user1!=null){
        if ($user->email != $user1->email) {
            return response()->json(["message"=>2]);
        }}
        $hashedPassword = Hash::make($request->password);
        $user = User::find($id);
        $user->update([
            // 'username' => '',
            'password' => $hashedPassword,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'role_id' => $request->role_id,
            'dob'=>$request->dob,
            'phoneNumber'=>$request->phoneNumber,
            'gender'=>$request->gender,
            'speciality'=>$request->speciality?$request->speciality:'',
            'activated' => $request->activated,
            'qualification'=> $request->qualification,
            'license_number'=> $request->license_number,
            'city'=>$request->city
        ]);

        return response()->json(["message"=>$user]);
    } catch (Exception $e) {
        return response()->json(['message' => 1, "error"=>$e->getMessage()]);
    }
  }

  public function deletedoctor($id){
    $user = User::find($id);
    $user->delete();
    return response()->json(['message' => 1]);
  }


  public function password(Request $request, $id){
    $hashedPassword = Hash::make($request->password);
    $user = User::find($id);
    $user->update([
        // 'username' => '',
        'password' => $hashedPassword
    ]);
    return response()->json(["message"=>$user]);
  }
}
