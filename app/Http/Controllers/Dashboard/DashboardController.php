<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageUploadHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    public function app_info()
    {
        // $app_info =  appInfo();

        // $info = [];

        // foreach ($app_info as $key => $value) {
        //     $info[] = [
        //         $key => gettype($value)
        //     ];
        // }

        // return $info;

        // return $app_info;
        
        // $jsonContents = file_get_contents($jsonFilePath);
        // $data = json_decode($jsonContents, true); // Set the second parameter to true for an associative array, or false for an object

        // Step 2: Modify the data
        // $data['name'] = 'John Doe'; // For example, update the 'name' field

        // // Step 3: Encode the updated data back to JSON
        // $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);

        // // Step 4: Save the updated JSON data back to the file
        // file_put_contents($jsonFilePath, $updatedJsonData);

        // $editRow = '';

        // return view('dashboard.app-info', compact('app_info','editRow'));

        $app_infos = json_decode(file_get_contents(config_path('app-info.json')), true);
        return view('dashboard.app-info', compact('app_infos'));
    }

    public function app_info_update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
      
        // Add new key-value if both newKey and newValue are provided.
        if (!empty($data['newKey']) && !empty($data['newValue'])) {
            $data[$data['newKey']] = $data['newValue'];
        }
        unset($data['newKey'], $data['newValue']); // remove them after processing

        // Loop through $data and remove any pairs where the value is null.
        foreach ($data as $key => $value) {
            if (is_null($value) || $value === '') {
                unset($data[$key]);
            }
        }

        file_put_contents(config_path('app-info.json'), json_encode($data, JSON_PRETTY_PRINT)); 

        return redirect()->route('app-info')->with('success', 'Settings updated successfully!');
    }
    
    public function popupEdit() {
        $editRow =  popupInfo();
        return view('dashboard.settings.popup', compact('editRow'));
    }

    public function popupUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => [
                Rule::requiredIf(function () use ($request) {
                    return is_null($request->hasFile('image'));
                }),
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                Rule::requiredIf(function () use ($request) {
                    return is_null($request->hasFile('image'));
                }),
                'nullable',
                'string',
                'max:255',
            ],
            'image' => [
                Rule::requiredIf(function () use ($request) {
                    return is_null($request->title);
                }),
                'nullable',
            ],
            'expire_date' => ['required', 'string'],
            "external_link" => ['nullable', 'string', 'max:255'],
        ]);

        $popupData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'expire_date' => $request->input('expire_date'),
            'external_link' => $request->input('external_link'),
        ];
        
        $existing_data = popupInfo();

        if($request->delete_image){
            $this->imageHelper->deleteImage('popup-images',$existing_data['image']);
            $popupData['image'] = null;
        }

        if ($request->hasFile('image')) {
            $imageName = $this->imageHelper->uploadImage('popup-images', $request->image, time().rand(10,1000), $request->image);
            $popupData['image'] = $imageName;
        }else{
            $popupData['image'] = null;
            if(!$request->delete_image && !$request->title){
                $popupData['image'] = $existing_data['image'];
            }
        }

        file_put_contents(config_path('popup.json'), json_encode($popupData, JSON_PRETTY_PRINT));

        return redirect()->route('popup.edit')->with('messege_success', 'Popup updated successfully');
    }
}
