<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Asegúrate de importar el modelo Usuario
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    //
    public function index()
    {
        // Aquí puedes implementar la lógica para traer los datos de usuarios
        $usuarios = Usuario::all(); // Reemplaza esto con tu lógica para obtener los datos de usuarios

        return view('pages.usuarios', ['usuarios' => $usuarios]);
    }

    //show one user
    public function show($id)
    {
        $user = Usuario::find($id);
        if (!$user) {
            return redirect()->route('usuarios.index')->with('error', 'User not found');
        }else {
            return view('pages.usuarios', ['user' => $user]);
        }
    }

    // get user data as JSON
    // This method is used to return user data in JSON format, typically for API responses

    public function getuserJson($id)
    {
        $user = Usuario::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function showJson($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    // Update the user information
    public function update($id, Request $request)
    {

        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'actual_password' => $request->input('actual_password'),  
            'role' => $request->input('role'),
            'actual_photo' => $request->input('actual_photo')
        );

        $password = array("password"=>$request->input('password'));
        if ($password) {
            $data['password'] = bcrypt($password['password']);
        }
        $photo = array("photo" => $request->file('photo'));

        if ($photo['photo']) {
            $validatedPhoto = \Validator::make($photo, [
                'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            
            if ($validatedPhoto->fails()) {
                return redirect()->route('usuarios.index')->with("no-validated","Failed to validate photo.");   
            }
        }

          /*  echo "<pre>";
        print_r($data); 
        echo "</pre>";
        return; 
 */
        // Validate the request data
        // This method is used to update the user information in the database
        if(!empty($data)){
            $validated = \Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',                
                'role' => 'required|string|max:50', 
            ]);            
        

            if($password['password'] != null) {
                $validatedPassword = \Validator::make(
                    [
                        'password' => $request->input('password'),
                        'password_confirmation' => $request->input('password_confirmation')
                    ],
                    [
                        'password' => 'required|string|min:8|confirmed',
                    ]
                );

                if($validatedPassword->fails()) {
                    return redirect("/usuarios")->with("no-validated","Failed to validate password.");
                } else {
                    $newPassword = Hash::make($password['password']);
                }

            }else {
                $newPassword = $data['actual_password'];
            }

            $validatedPhoto = null;
            if($photo['photo'] != null) {
                $validatedPhoto = \Validator::make($photo, [
                    'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
                ]);
                if($validatedPhoto->fails()) {
                    return redirect("/usuarios")->with("no-validated","Failed to validate photo.");   
                }
            }

            if ($validated->fails()) {
                return redirect("/usuarios")->with("no-validated","Failed to validate data."); 
            }else {

                if($photo['photo'] != null) {
                    if ($data['actual_photo']) {
                        @unlink(public_path($data['actual_photo']));
                    }
                    $randerFile = mt_rand(1000, 9999);
                    $fileName = $randerFile . '_' . time() . '.' . $photo["photo"]->guessExtension();                
                    $routePhoto = '/img/users/'.$fileName; 
                    $photo["photo"]->move(public_path('/img/users/'), $fileName);
                } else {
                    $routePhoto = $data['actual_photo'];
                }

                $data = array(
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $newPassword,
                    'role' => $data['role'],
                    'photo' => $routePhoto
                );

                $user = Usuario::where("id",$id)->update($data);
                
                if (!$user) {
                    return redirect()->route('usuarios.index')->with('error', 'User not found');
                }                
            }
            return redirect()->route('usuarios.index')->with('success', 'User updated successfully');
        } else {
                return redirect()->route('usuarios.index')->with('error', 'No data provided');
        }

    }

    // Delete the user (user) from the database
    // This method is used to delete the user from the database
    public function destroy($id)
    {
        $user = Usuario::find($id);
        if (!$user) {
            return redirect()->route('usuarios.index')->with('error', 'User not found');
        }
        $user->delete();
        return redirect()->route('usuarios.index')->with('success', 'User deleted successfully');
    }

}
