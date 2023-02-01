Laravel Rest API Template 
- Authentication/Registration Done by Sanctum

Below are sample routes for this particular application (must put in api routes file)

//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


//protected routes
Route::get('/posts', [BlogsController::class, 'index']);
Route::get('/posts/{id}', [BlogsController::class, 'show']);
Route::post('/posts', [BlogsController::class, 'store']);
Route::put('/posts/{id}', [BlogsController::class,  'update']);
Route::delete('/posts/{id}', [BlogsController::class, 'delete']);
Route::post('/logout', [AuthController::class, 'logout']);
   

