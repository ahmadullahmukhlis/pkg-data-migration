<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class exportController extends Controller
{
    public function insertCatagory()
    {
        $filePath = storage_path('app/category_seeder.json');
        $json = File::get($filePath);
        $jsonData = json_decode($json, true);
        if (!is_array($jsonData) || !isset($jsonData['data'])) {
            return response()->json(['error' => 'Invalid JSON structure'], 400);
        }
        foreach ($jsonData['data'] as $item) {
            $createdAt = Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s');
            DB::insert('INSERT INTO `baheer-group-for-test`.`categories` (id, name, created_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [
                $item['id'],
                $item['name'],
                $item['created_by'],
                $createdAt,
                $updatedAt,
            ]);
        }
        return 'the data is save ';
    }
    public function category()
    {
        $ppCustomers = DB::select('select CustCatagory from ppcustomer group by CustCatagory ');
        $mappedData = [];
        $i = 6;
        foreach ($ppCustomers as $customer) {
            $mappedData[] = [
                'id' => $i,
                'name' => $customer->CustCatagory,
                'created_by' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $i++;
        }

        // Define the file path for the JSON file
        $filePath = storage_path('app/category_seeder.json');

        // Convert the mapped data into JSON format
        $jsonData = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_customers',
            'data' => $mappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($filePath, $jsonData);

        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $filePath]);
    }
    public function insertSpecification()
    {
        $filePath = storage_path('app/specification_seeder.json');
        $json = File::get($filePath);
        $jsonData = json_decode($json, true);
        if (!is_array($jsonData) || !isset($jsonData['data'])) {
            return response()->json(['error' => 'Invalid JSON structure'], 400);
        }
        foreach ($jsonData['data'] as $item) {
            $createdAt = Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s');
            DB::insert('INSERT INTO `baheer-group-for-test`.`specifications` (id, customer_specification,range_from,range_to ,created_by, created_at, updated_at,department_id) VALUES (?,?,?,?, ?, ?, ?, ?)', [
                $item['id'],
                $item['customer_specification'],
                $item['range_from'],
                $item['range_to'],
                $item['created_by'],
                $createdAt,
                $updatedAt,
                $item['department_id'],
            ]);
        }
        return 'the data is save ';
    }
    public function specification()
    {
        $ppCustomers = DB::select('select CusSpecification from ppcustomer group by CusSpecification ');
        $mappedData = [];
        $i = 6;
        foreach ($ppCustomers as $customer) {
            $mappedData[] = [
                'id' => $i,
                'customer_specification' => $customer->CusSpecification,
                'range_from' => 3,
                'range_to' => 3,
                'created_by' => null,
                'department_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $i++;
        }

        // Define the file path for the JSON file
        $filePath = storage_path('app/specification_seeder.json');

        // Convert the mapped data into JSON format
        $jsonData = json_encode([
            'type' => 'table',
            'name' => 'specifications',
            'data' => $mappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($filePath, $jsonData);

        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $filePath]);
    }
    public function insertBusinessType()
    {
        $filePath = storage_path('app/business_types_seeder.json');
        $json = File::get($filePath);
        $jsonData = json_decode($json, true);
        if (!is_array($jsonData) || !isset($jsonData['data'])) {
            return response()->json(['error' => 'Invalid JSON structure'], 400);
        }
        foreach ($jsonData['data'] as $item) {
            $createdAt = Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s');
            DB::insert('INSERT INTO `baheer-group-for-test`.`business_types` ( name,class,created_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [
                $item['name'],
                $item['class'],
                $item['created_by'],
                $createdAt,
                $updatedAt,
            ]);
        }
        return 'the data is save ';
    }
    public function businessType()
    {
        $ppCustomers = DB::select('select BusinessType from ppcustomer group by BusinessType ');
        $mappedData = [];
        $i = 6;
        foreach ($ppCustomers as $customer) {
            $mappedData[] = [
                'id' => $i,
                'name' => $customer->BusinessType,
                'class' => 'PKG',
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $i++;
        }

        // Define the file path for the JSON file
        $filePath = storage_path('app/business_types_seeder.json');

        // Convert the mapped data into JSON format
        $jsonData = json_encode([
            'type' => 'table',
            'name' => 'business_types',
            'data' => $mappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($filePath, $jsonData);

        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $filePath]);
    }
    public function insertReference()
    {
        $filePath = storage_path('app/references_seeder.json');
        $json = File::get($filePath);
        $jsonData = json_decode($json, true);
        if (!is_array($jsonData) || !isset($jsonData['data'])) {
            return response()->json(['error' => 'Invalid JSON structure'], 400);
        }
        foreach ($jsonData['data'] as $item) {
            if ($item['name'] !== 'Tamim Ranjbar') {
                $createdAt = Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
                $updatedAt = Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s');
                DB::insert('INSERT INTO `baheer-group-for-test`.`references` ( name,created_by, created_at, updated_at) VALUES ( ?, ?, ?, ?)', [
                    $item['name'],
                    $item['created_by'],
                    $createdAt,
                    $updatedAt,
                ]);
            }
        }
        return 'the data is save ';
    }
    public function reference()
    {
        $ppCustomers = DB::select('SELECT CusReference FROM ppcustomer WHERE CusReference IS NOT NULL GROUP BY CusReference ');
        $mappedData = [];
        $i = 6;
        foreach ($ppCustomers as $customer) {
            $mappedData[] = [
                'id' => $i,
                'name' => $customer->CusReference,
                'created_by' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ];
            $i++;
        }

        // Define the file path for the JSON file
        $filePath = storage_path('app/references_seeder.json');

        // Convert the mapped data into JSON format
        $jsonData = json_encode([
            'type' => 'table',
            'name' => 'references',
            'data' => $mappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($filePath, $jsonData);

        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $filePath]);
    }
    public function insertCustomer()
    {
        // Define the file path for the JSON file
        $filePath = storage_path('app/ppcustomer_seeder.json');

        // Check if the file exists
        if (!File::exists($filePath)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        // Read and decode the JSON data from the file
        $jsonData = File::get($filePath);
        $data = json_decode($jsonData, true);

        if (!isset($data['data']) || empty($data['data'])) {
            return response()->json(['message' => 'No data found in the JSON file'], 400);
        }

        // Loop through each customer in the data and insert using raw SQL
        foreach ($data['data'] as $customer) {
            $updatedAt = Carbon::parse($customer['updated_at'])->format('Y-m-d H:i:s');

            // Split the time_line into its components (e.g., "12 Month")
            $item = explode(' ', $customer['time_line'], 2); // Limit to 2 parts

            // Set default values if the explode doesn't return both parts
            $timeline = isset($item[0]) && is_numeric($item[0]) ? (int) $item[0] : 1;
            $type = isset($item[1]) ? $item[1] : null;
            // Handle status mapping
            $status = null;
            if ($customer['status'] == 'Disable') {
                $status = 'inactive';
            } elseif ($customer['status'] == 'Active') {
                $status = 'active';
            } elseif ($customer['status'] == 'InActive') {
                $status = 'inactive';
            } elseif ($customer['status'] == 'Pending') {
                $status = 'waiting';
            } elseif ($customer['status'] == 'Deactive') {
                $status = 'inactive';
            } elseif ($customer['status'] == 'Delete') {
                $status = 'inactive';
            } elseif ($customer['status'] == 'Prospect') {
                $status = 'prospect';
            }
            $nature = null;
            if ($customer['bussness_nature']) {
                $nature = $customer['bussness_nature'];
            } else {
                $nature = ' ';
            }
            DB::insert(
                'INSERT INTO `baheer-group-for-test`.`bgpkg_customers`
                    ( customer_name, contact_person, job_title, gender, qoutation_sending_address,
                    finish_goods_shipment_address, time_line, time_line_type, full_address, status, category_id,
                    specification_id, business_type_id, branch_id, payment_term_id, country_id, state_id,
                    region_id, reference_id, created_by, approved_by, assign_to, bussness_nature, logo, extras,
                    created_at, updated_at)
                VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [

                    $customer['customer_name'],
                    $customer['contact_person'],
                    $customer['job_title'],
                    $customer['gender'],
                    $customer['qoutation_sending_address'],
                    $customer['finish_goods_shipment_address'],
                    $timeline,   // Handle the timeline part safely
                    $type,       // Handle the time type part safely
                    $customer['full_address'],
                    $status,
                    $customer['category_id'],
                    $customer['specification_id'],
                    $customer['business_type_id'],
                    $customer['branch_id'],
                    $customer['payment_term_id'],
                    $customer['country_id'],
                    $customer['state_id'],
                    $customer['region_id'],
                    $customer['reference_id'],
                    $customer['created_by'],
                    $customer['approved_by'],
                    $customer['assign_to'],
                    $nature,
                    $customer['logo'],
                    $customer['extras'],
                    $customer['created_at'],
                    $updatedAt
                ]
            );
        }

        // Return a success response
        return response()->json(['message' => 'Data inserted successfully!']);
    }



    public function customer()
    {
        // Retrieve all customers from the ppcustomer table
        $ppCustomers = DB::table('ppcustomer')->get();
        $mappedData = [];

        foreach ($ppCustomers as $customer) {
            // Use parameterized queries to avoid SQL injection
            $catagory = DB::table('baheer-group-for-test.categories')
                ->where('name', $customer->CustCatagory)
                ->value('id');

            $reference = DB::table('baheer-group-for-test.references')
                ->where('name', $customer->CusReference)
                ->value('id');

            $business_type = DB::table('baheer-group-for-test.business_types')
                ->where('name', $customer->BusinessType)
                ->value('id');

            $specification = DB::table('baheer-group-for-test.specifications')
                ->where('customer_specification', $customer->CusSpecification)
                ->value('id');

            $assign = DB::table('baheer-group-for-test.users')
                ->where('employee_id', $customer->FollowupResponsible)
                ->value('id');

            // Map the data for each customer
            $mappedData[] = [
                'id' => $customer->CustId,
                'customer_name' => $customer->CustName,
                'contact_person' => $customer->CustContactPerson,
                'job_title' => $customer->CustPostion,
                'gender' => 'male',
                'qoutation_sending_address' => null,
                'finish_goods_shipment_address' => null,
                'time_line' => $customer->Timelimit,
                'time_line_type' => null,
                'full_address' => $customer->CustAddress,
                'status' => $customer->CusStatus,
                'category_id' => $catagory,
                'specification_id' => $specification,
                'business_type_id' => $business_type,
                'branch_id' => 1,
                'payment_term_id' => 1,
                'country_id' => 2,
                'state_id' => 8,
                'region_id' => 3,
                'reference_id' => $reference,
                'created_by' => null,
                'approved_by' => null,
                'assign_to' => $assign,
                'bussness_nature' => $customer->BusinessNature,
                'logo' => null,
                'extras' => null,
                'created_at' => $customer->CusRegistrationDate,
                'updated_at' => now(),
            ];
        }

        // Define the file path for the JSON file
        $filePath = storage_path('app/ppcustomer_seeder.json');

        // Convert the mapped data into JSON format
        $jsonData = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_customers',
            'data' => $mappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($filePath, $jsonData);

        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $filePath]);
    }
    public function contact()
    {
        // Retrieve all customers from the ppcustomer table
        $ppCustomers = DB::table('ppcustomer')->get();
        $mappedData = [];

        foreach ($ppCustomers as $customer) {
            // Use parameterized queries to avoid SQL injection
            $new_customer = DB::table('baheer-group-for-test.bgpkg_customers')
                ->where('customer_name', 'like', '%' . $customer->CustName . '%')->where('created_at', $customer->CusRegistrationDate)
                ->value('id');
            $mappedData[] = [
                'work_phone' => $customer->CustWorkPhone,
                'personal_phone' => null,
                'whatsapp' => $customer->CmpWhatsApp,
                'main_email' => $customer->CustEmail,
                'cc_email' => null,
                'website_url' => $customer->CustWebsite,
                'contactable_type' => 'App\Models\Bgpkg\BgpkgCustomer',
                'contactable_id' => $new_customer,
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Define the file path for the JSON file
        $filePath = storage_path('app/contacts.json');

        // Convert the mapped data into JSON format
        $jsonData = json_encode([
            'type' => 'table',
            'name' => 'contacts',
            'data' => $mappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($filePath, $jsonData);

        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $filePath]);
    }
    public function insertContact()
    {
        $filePath = storage_path('app/contacts.json');

        // Retrieve the contents of the JSON file
        $json = File::get($filePath);
        $jsonData = json_decode($json, true);

        // Validate the JSON structure
        if (!is_array($jsonData) || !isset($jsonData['data'])) {
            return response()->json(['error' => 'Invalid JSON structure'], 400);
        }

        // Loop through each item in the JSON data
        foreach ($jsonData['data'] as $item) {

            $createdAt = Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s');

            // Insert data into the 'contacts' table using a parameterized query
            DB::insert('INSERT INTO `baheer-group-for-test`.`contacts`
                    (work_phone, personal_phone, whatsapp, main_email, cc_email, website_url, contactable_type, contactable_id, created_by, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $item['work_phone'],
                $item['personal_phone'],
                $item['whatsapp'],
                $item['main_email'],
                $item['cc_email'],
                $item['website_url'],
                $item['contactable_type'],
                $item['contactable_id'],
                $item['created_by'],
                $createdAt,
                $updatedAt,
            ]);
        }

        // Return a success response
        return response()->json(['message' => 'Data saved successfully!']);
    }
    public function product()
    {
        // Retrieve all customers from the ppcustomer table
        $cartons = DB::table('carton')->get();
        $ProductmappedData = [];
        $ordermappedData = [];

        foreach ($cartons as $carton) {
            // Use parameterized queries to avoid SQL injection
            $new_customer = DB::table('baheer-group-for-test.bgpkg_customers')
                ->where('customer_name', 'like', '%' . $carton->CustName . '%')->where('created_at', $carton->CusRegistrationDate)
                ->value('id');
            $ProductmappedData[] = [
                'id' => $carton->CustWorkPhone,
                'product_code' => null,
                'customer_id' => $carton->CmpWhatsApp,
                'branch' => $carton->CustEmail,
                'product_status' => null,
                'product_name' => $carton->CustWebsite,
                'product_type' => 'App\Models\Bgpkg\BgpkgCustomer',
                'length' => $new_customer,
                'height' => null,
                'width' => null,
                'carton_type' => null,
                'flute_type' => null,
                'die_cut' => null,
                'pasting' => null,
                'sloted' => null,
                'stitching' => null,
                'stitching_type' => null,
                'flexo_p' => null,
                'offset_p' => null,
                'glue' => null,
                'glue_type' => null,
                'color' => null,
                'polymer' => null,
                'polymer_price' => null,
                'die' => null,

                'die_type' => null,
                'die_price' => null,
                'flap_type' => null,
                'flap_length' => null,
                'flap_width' => null,
                'tax' => null,
                'payment_term_id' => null,
                'payment_method_id' => null,
                'design_type' => null,
                'paper_weight' => null,
                'waste_weight' => null,
                'sheet_size' => null,
                'deadline' => null,
                'job_card_note' => null,
                'quotation_note' => null,
                'produced_quantity' => null,
                'stockout_quantity' => null,
                'agreement' => null,
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $ordermappedData[] = [
                'id' => $carton->CustWorkPhone,
                'product_id' => null,
                'order_type' => $carton->CmpWhatsApp,
                'order_quantity' => $carton->CustEmail,
                'currency' => null,
                'manual_grade' => $carton->CustWebsite,
                'unit_price' => 'App\Models\Bgpkg\BgpkgCustomer',
                'total_price' => $new_customer,
                'glue_cost' => null,
                'die_cost' => null,
                'polymer_cost' => null,
                'labor_cost' => null,
                'paper_cost' => null,
                'waste_cost' => null,
                'electricity_cost' => null,
                'profit_cost' => null,
                'depreciation' => null,
                'exchange_rate' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Define the file path for the JSON file
        $productJson = storage_path('app/products.json');
        $orderJson = storage_path('app/orders.json');


        // Convert the mapped data into JSON format
        $productJsonData = json_encode([
            'type' => 'table',
            'name' => 'products',
            'data' => $ProductmappedData,
        ], JSON_PRETTY_PRINT);
        $orderJsonData = json_encode([
            'type' => 'table',
            'name' => 'orders',
            'data' => $ordermappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($productJson, $productJsonData);
        File::put($orderJson, $orderJsonData);


        // Return a success response or the path to the saved file
        return response()->json(['message' => 'Data exported successfully!', 'file' => $productJsonData, 'order' => $orderJsonData]);
    }
}
