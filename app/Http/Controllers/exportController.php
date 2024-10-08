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
        $total = 1;
        foreach ($cartons as $carton) {
            $customer = DB::table('ppcustomer')->where('CustId', $carton->CustId1)->first();
            if (!$customer) {
                continue;
            }
            $orderDate = Carbon::parse($carton->CTNOrderDate);
            $year = $orderDate->format('y');
            $code = 'PKG' . $year . '-' . $carton->CTNId;
            $new_customer = DB::table('baheer-group-for-test.bgpkg_customers')
                ->where('customer_name', 'like', '%' . $customer->CustName . '%')
                ->where('created_at', $customer->CusRegistrationDate)
                ->first();

            if (!$new_customer) {
                continue; // Skip if new_customer not found
            }
            $desgn = 'new_design';
            if ($carton->DesignChecker == 'ExistDesign') {
                $desgn = 'design_exist';
            } else   if ($carton->DesignChecker == 'EditExistDesign') {
                $desgn = 'design_exist_edit';
            } else   if ($carton->DesignChecker == '') {
                $desgn = 'no_print';
            }
            // Product mapped data
            $ProductmappedData[] = [
                'id' => $carton->CTNId,
                'product_code' => $code,
                'customer_id' => $new_customer->id,
                'branch' => $new_customer->branch_id,
                'product_status' => $carton->CTNStatus,
                'product_name' => $carton->ProductName,
                'product_type' => $carton->CTNUnit == 'Separator' ? 'Seperator' : $carton->CTNUnit,
                'length' => $carton->CTNWidth,
                'height' => $carton->CTNHeight,
                'width' => $carton->CTNLength,
                'carton_type' => $carton->CTNType == 'Select Ply Type' ? 3 : $carton->CTNType,
                'flute_type' => $carton->CFluteType,
                'die_cut' => $carton->CDieCut == 'Yes' ? 1 : 0,
                'pasting' => $carton->CPasting == 'Yes' ? 1 : 0,
                'sloted' => $carton->CSlotted == 'Yes' ? 1 : 0,
                'stitching' => $carton->CStitching == 'Yes' ? 1 : 0,
                'stitching_type' => null,
                'flexo_p' => $carton->flexop == 'Yes' ? 1 : 0,
                'offset_p' => $carton->offesetp == 'Yes' ? 1 : 0,
                'glue' => 0,
                'glue_type' => null,
                'color' => $carton->CTNColor,
                'polymer' => $carton->PolyId == null  ? 'New' : 'Exist',
                'polymer_price' => $carton->CTNPolimarPrice,
                'die' => $carton->DieId == null ? 'New' : 'Exist',
                'die_type' => null,
                'die_price' => $carton->CTNDiePrice,
                'flap_type' => $carton->NoFlip,
                'flap_length' => null,
                'flap_width' => null,
                'tax' => $carton->Tax,
                'payment_term_id' => 1,
                'payment_method_id' => 1,
                'design_type' => $desgn,
                'paper_weight' => null,
                'waste_weight' => null,
                'sheet_size' => null,
                'deadline' => $carton->CTNFinishDate,
                'job_card_note' => $carton->Note,
                'quotation_note' => $carton->MarketingNote,
                'produced_quantity' => $carton->ProductQTY ?? 0,
                'stockout_quantity' => 0,
                'agreement' => null,
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];


            echo 'the total is  =  ' . ++$total . '<br/>';
        }

        // Define the file paths for the JSON files
        $productJson = storage_path('app/products.json');

        $productJsonData = json_encode([
            'type' => 'table',
            'name' => 'products',
            'data' => $ProductmappedData,
        ], JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        File::put($productJson, $productJsonData);
        return response()->json([
            'message' => 'Data exported successfully!',
        ]);
    }


    public function insertProduct()
    {
        // Define file paths for JSON files
        $productFilePath = storage_path('app/products.json');
        // Retrieve and parse the contents of each JSON file
        $productJson = File::get($productFilePath);
        $productJsonData = json_decode($productJson, true);


        // Validate JSON structure for products
        if (!is_array($productJsonData) || !isset($productJsonData['data'])) {
            return response()->json(['error' => 'Invalid products JSON structure'], 400);
        }

        // Insert products into the 'products' table
        foreach ($productJsonData['data'] as $item) {
            $createdAt = isset($item['created_at']) ? Carbon::parse($item['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($item['updated_at']) ? Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_products`
                (id, product_code, customer_id, branch_id, product_status, product_name, product_type, length, height, width, carton_type, flute_type, die_cut, pasting, sloted, stitching, stitching_type, flexo_p, offset_p, glue, glue_type, color, polymer, polymer_price, die, die_type, die_price, flap_type, flap_length, flap_width, tax, payment_term_id, payment_method_id, design_type, paper_weight, waste_weight, sheet_size, deadline, job_card_note, quotation_note, produced_quantity, stockout_quantity, agreement, created_by, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $item['id'],
                $item['product_code'],
                $item['customer_id'],
                $item['branch'],
                'active',
                // $item['product_status'],
                $item['product_name'],
                $item['product_type'],
                $item['length'],
                $item['height'],
                $item['width'],
                $item['carton_type'],
                $item['flute_type'],
                $item['die_cut'],
                $item['pasting'],
                $item['sloted'],
                $item['stitching'],
                $item['stitching_type'],
                $item['flexo_p'],
                $item['offset_p'],
                $item['glue'],
                $item['glue_type'],
                $item['color'],
                $item['polymer'],
                $item['polymer_price'],
                $item['die'],
                $item['die_type'],
                $item['die_price'],
                $item['flap_type'],
                $item['flap_length'],
                $item['flap_width'],
                $item['tax'],
                $item['payment_term_id'],
                $item['payment_method_id'],
                $item['design_type'],
                $item['paper_weight'],
                $item['waste_weight'],
                $item['sheet_size'],
                $item['deadline'],
                $item['job_card_note'],
                $item['quotation_note'],
                $item['produced_quantity'],
                $item['stockout_quantity'],
                $item['agreement'],
                $item['created_by'],
                $createdAt,
                $updatedAt,
            ]);
        }

        // Return a success response
        return response()->json(['message' => 'Products, orders, and product details saved successfully!']);
    }
    public function order()
    {
        $cartons = DB::table('carton')->get();
        $ordermappedData = [];
        $total = 1;

        foreach ($cartons as $carton) {
            $order_type = 'New Order';
            if ($carton->reorder_status == 'Yes') {
                $order_type = 'Re Order';
            }
            $ordermappedData[] = [
                'id' => $carton->CTNId,
                'product_id' => $carton->CTNId,
                'order_type' => $order_type,
                'order_quantity' => $carton->CTNQTY ?? 0,
                'currency' => $carton->CtnCurrency,
                'manual_grade' => 50,
                'unit_price' => $carton->CTNPrice ?? 0,
                'total_price' => $carton->CTNTotalPrice ?? 0,
                'glue_cost' => 0,
                'die_cost' => $carton->CTNDiePrice ?? 0,
                'polymer_cost' => $carton->CTNPolimarPrice ?? 0,
                'labor_cost' => 0,
                'paper_cost' => 0,
                'waste_cost' => 0,
                'electricity_cost' => 0,
                'profit_cost' => 0,
                'depreciation' => 0,
                'exchange_rate' => $carton->PexchangeUSD ?? 0,
                'created_at' => $carton->CTNOrderDate ?? now(),
                'updated_at' => now(),
            ];
            echo 'the total is  =  ' . ++$total . '<br/>';
        }
        $orderJson = storage_path('app/orders.json');
        $orderJsonData = json_encode([
            'type' => 'table',
            'name' => 'orders',
            'data' => $ordermappedData,
        ], JSON_PRETTY_PRINT);
        File::put($orderJson, $orderJsonData);

        return response()->json(['success' => 200]);
    }
    public function insertOrder()
    {
        $orderFilePath = storage_path('app/orders.json');
        $orderJson = File::get($orderFilePath);
        $orderJsonData = json_decode($orderJson, true);
        // Validate JSON structure for orders
        if (!is_array($orderJsonData) || !isset($orderJsonData['data'])) {
            return response()->json(['error' => 'Invalid orders JSON structure'], 400);
        }

        // Insert orders into the 'orders' table
        foreach ($orderJsonData['data'] as $item) {
            $createdAt = isset($item['created_at']) ? Carbon::parse($item['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($item['updated_at']) ? Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_orders`
                (id, product_id, order_type, order_quantity, currency, manual_grade, unit_price, total_price, glue_cost, die_cost, polymer_cost, labor_cost, paper_cost, waste_cost, electricity_cost, profit_cost, depreciation, exchange_rate, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $item['id'],
                $item['product_id'],
                $item['order_type'],
                $item['order_quantity'],
                $item['currency'],
                $item['manual_grade'],
                $item['unit_price'],
                $item['total_price'],
                $item['glue_cost'],
                $item['die_cost'],
                $item['polymer_cost'],
                $item['labor_cost'],
                $item['paper_cost'],
                $item['waste_cost'],
                $item['electricity_cost'],
                $item['profit_cost'],
                $item['depreciation'],
                $item['exchange_rate'],
                $createdAt,
                $updatedAt,
            ]);
        }
        return response()->json(['message' => 'Products, orders, and product details saved successfully!']);
    }
    public function paper()
    {
        $batchSize = 1000; // Process 1000 records at a time
        $cartonQuery = DB::table('carton');
        $totalCartons = $cartonQuery->count(); // Get total cartons count
        $totalProcessed = 0;

        $detials = [];

        // Process cartons in batches
        for ($offset = 0; $offset < $totalCartons; $offset += $batchSize) {
            $cartons = $cartonQuery->offset($offset)->limit($batchSize)->get(); // Fetch batch of cartons

            foreach ($cartons as $carton) {
                for ($i = 1; $i <= $carton->CTNType; $i++) {
                    // Check if dynamic properties like CTNType1, PaperP1, etc. exist before using them
                    $typeKey = 'CTNType' . $i;
                    $paperPriceKey = 'PaperP' . $i;

                    if (isset($carton->$typeKey) && isset($carton->$paperPriceKey)) {
                        $detials[] = [
                            'product_id' => $carton->CTNId,
                            'paper_name' => isset($carton->Ctnp) ? $carton->Ctnp . $i : null,
                            'paper_gsm' => 125,
                            'paper_price' => $carton->$paperPriceKey,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
                echo 'The total processed is = ' . ++$totalProcessed . '<br/>';
            }

            // Write to file in chunks after each batch
            $paperJson = storage_path('app/bgpkg_product_details.json');
            $productDetailsJsonData = json_encode([
                'type' => 'table',
                'name' => 'bgpkg_product_details',
                'data' => $detials,
            ], JSON_PRETTY_PRINT);
            File::put($paperJson, $productDetailsJsonData);

            // Clear memory after each batch to avoid memory overload
            $detials = [];
            gc_collect_cycles(); // Force garbage collection
        }

        return response()->json(['success' => 200, 'total_processed' => $totalProcessed]);
    }
    public function insertPaper()
    {
        $productDetailsFilePath = storage_path('app/bgpkg_product_details.json');
        $productDetailsJson = File::get($productDetailsFilePath);
        $productDetailsJsonData = json_decode($productDetailsJson, true);
        // Validate JSON structure for product details
        if (!is_array($productDetailsJsonData) || !isset($productDetailsJsonData['data'])) {
            return response()->json(['error' => 'Invalid product details JSON structure'], 400);
        }

        // Insert product details into the 'bgpkg_product_details' table
        foreach ($productDetailsJsonData['data'] as $item) {
            $createdAt = isset($item['created_at']) ? Carbon::parse($item['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($item['updated_at']) ? Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_product_details`
        (product_id, paper_name, paper_gsm, paper_price, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?)', [
                $item['product_id'],
                $item['paper_name'],
                $item['paper_gsm'],
                $item['paper_price'],
                $createdAt,
                $updatedAt,
            ]);
        }
        return response()->json(['message' => 'Products, orders, and product details saved successfully!']);
    }
}
