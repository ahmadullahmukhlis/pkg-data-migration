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
        $cartons = DB::table('carton')->get();
        $detials = [];
        $totalProcessed = 0;
        $paperJson = storage_path('app/bgpkg_product_details.json'); // Path to the JSON file

        // Initialize file by clearing old content before appending new data
        File::put($paperJson, '');

        // Fetch batch of cartons
        foreach ($cartons as $carton) {
            $totalProcessed++; // Track the number of cartons processed

            if ($carton->CTNType == 'Select Ply Type') {
                $type = 3;
            } else {
                $type = (int) $carton->CTNType;
            }

            for ($i = 1; $i <= $type; $i++) {
                // Dynamically check if the type and paper price fields exist
                $paperPriceKey = 'PaperP' . $i;
                $paperNameKey = 'Ctnp' . $i; // Dynamically constructing column name for paper name

                if (isset($carton->$paperPriceKey)) {
                    $detials[] = [
                        'product_id' => $carton->CTNId,
                        'paper_name' => isset($carton->$paperNameKey) ? trim($carton->$paperNameKey) : null, // Remove leading/trailing spaces
                        'paper_gsm' => 125, // Assuming GSM is always 125, you can adjust if needed
                        'paper_price' => $carton->$paperPriceKey,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Write to file in chunks after each batch to avoid memory overload
        if (!empty($detials)) {
            $productDetailsJsonData = json_encode([
                'type' => 'table',
                'name' => 'bgpkg_product_details',
                'data' => $detials,
            ], JSON_PRETTY_PRINT);

            // Append the data to the file instead of overwriting it
            File::append($paperJson, $productDetailsJsonData . PHP_EOL);

            // Clear memory after each batch
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
    public function die()
    {
        $dies = DB::table('cdie')->get();
        $diearray = [];
        $sckach = [];

        foreach ($dies as $die) {
            $customer = DB::table('ppcustomer')->where('CustId', $die->CDCompany)->first();
            $orderDate = Carbon::parse($die->CDMadeDate);
            $year = $orderDate->format('y');
            $code = 'PKG' . $year . '-' . $die->CDieId;

            // Fetch new customer
            $new_customer = DB::table('baheer-group-for-test.bgpkg_customers')
                ->where('customer_name', 'like', '%' . $customer->CustName . '%')
                ->where('created_at', $customer->CusRegistrationDate)
                ->first();

            // Fetch order related to die
            $order = DB::table('carton')->where('DieId', $die->CDieId)->first();

            // Collect die data
            $diearray[] = [
                'id' => $die->CDieId,
                'number' => $code,
                'app' => $die->App ?? 0,
                'size' => $die->CDSize,
                'status' => null,
                'code' => $code,
                'location' => $die->CDLocation,
                'type' => $die->DieType,
                'simple' => $die->CDSampleNo,
                'shelf' => null,
                'made' => $die->CDMade,
                'property' => $die->CDOwner,
                'bgpkg_customer_id' => $new_customer->id ?? null,
                'bgpkg_order_id' => $order->CTNId ?? null,
                'created_by' => null,
                'branch_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Collect scratch (sckach) file data
            if ($die->Scatch) {
                $sckach[] = [
                    'name' => $die->Scatch,
                    'file_name' => $die->Scatch,
                    'mime_type' => 'application/pdf',
                    'path' => storage_path("app/public/bgpkg/dies/{$die->Scatch}"),
                    'disk' => 'public',
                    'file_hash' => '',
                    'collection' => '',
                    'size' => 2, // Assuming the size is 2, adjust as needed
                    'mediable_type' => 'App\Models\Bgpkg\BgpkgDie',
                    'mediable_id' => $die->CDieId
                ];
            }
        }

        // Write die data to the bgpkg_dies.json file
        $dieJson = storage_path('app/bgpkg_dies.json');
        $dieFile = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_dies',
            'data' => $diearray,
        ], JSON_PRETTY_PRINT);
        File::put($dieJson, $dieFile);

        // Write scratch data to the sckatch.json file
        $sckachJson = storage_path('app/sckatch.json');
        $sckachFile = json_encode([
            'type' => 'table',
            'name' => 'media',
            'data' => $sckach,
        ], JSON_PRETTY_PRINT);
        File::put($sckachJson, $sckachFile);

        return response()->json(['success' => 200]);
    }

    public function insertDie()
    {
        // Paths to the JSON files
        $dieJsonFilePath = storage_path('app/bgpkg_dies.json');
        $sckachJsonFilePath = storage_path('app/sckatch.json');

        // Check if the files exist
        if (!File::exists($dieJsonFilePath) || !File::exists($sckachJsonFilePath)) {
            return response()->json(['error' => 'JSON files not found'], 404);
        }

        // Read and decode the die JSON file
        $dieJson = File::get($dieJsonFilePath);
        $dieJsonData = json_decode($dieJson, true);

        // Read and decode the sckach JSON file
        $sckachJson = File::get($sckachJsonFilePath);
        $sckachJsonData = json_decode($sckachJson, true);

        // Validate JSON structure for die data
        if (!is_array($dieJsonData) || !isset($dieJsonData['data'])) {
            return response()->json(['error' => 'Invalid die JSON structure'], 400);
        }

        // Validate JSON structure for sckach data
        if (!is_array($sckachJsonData) || !isset($sckachJsonData['data'])) {
            return response()->json(['error' => 'Invalid sckach JSON structure'], 400);
        }

        // Insert die data into the 'bgpkg_dies' table
        foreach ($dieJsonData['data'] as $die) {
            $createdAt = isset($die['created_at']) ? Carbon::parse($die['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($die['updated_at']) ? Carbon::parse($die['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_dies`
                (id, number, app, size, status, code, location, type, simple, shelf, made, property, bgpkg_customer_id, bgpkg_order_id, created_by, branch_id, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $die['id'],
                $die['number'],
                $die['app'],
                $die['size'],
                $die['status'],
                $die['code'],
                $die['location'],
                $die['type'],
                $die['simple'],
                $die['shelf'],
                $die['made'],
                $die['property'],
                $die['bgpkg_customer_id'],
                $die['bgpkg_order_id'],
                $die['created_by'],
                $die['branch_id'],
                $createdAt,
                $updatedAt,
            ]);
        }

        // Insert sckach (scratch file) data into the 'media' table
        foreach ($sckachJsonData['data'] as $sckach) {
            DB::insert('INSERT INTO `baheer-group-for-test`.`media`
                (name, file_name, mime_type, path, disk, file_hash, collection, size, mediable_type, mediable_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $sckach['name'],
                $sckach['file_name'],
                $sckach['mime_type'],
                $sckach['path'],
                $sckach['disk'],
                $sckach['file_hash'],
                $sckach['collection'],
                $sckach['size'],
                $sckach['mediable_type'],
                $sckach['mediable_id']
            ]);
        }

        return response()->json(['message' => 'Dies and associated scratch files inserted successfully!']);
    }

    public function polymer()
    {
        $dies = DB::table('cpolymer')->get();
        $polymer = [];
        $iteration = 1; // Start the iteration counter

        foreach ($dies as $die) {
            $customer = DB::table('ppcustomer')->where('CustId', $die->CompId)->first();
            if (!$customer) {
                continue;
            }
            $new_customer = DB::table('baheer-group-for-test.bgpkg_customers')
                ->where('customer_name', 'like', '%' . $customer?->CustName . '%')
                ->where('created_at', $customer?->CusRegistrationDate)
                ->first();

            // Fetch order related to die
            $order = DB::table('carton')->where('PolyId', $die->CPid)->first();

            // Collect die data
            $polymer[] = [
                'id' => $die->CPid,
                'number' => $die->CPNumber,
                'app' => $iteration, // Use the iteration counter here
                'size' => $die->Psize,
                'status' => $die->PStatus,
                'color' => $die->PColor,
                'location' => $die->PLocation,
                'mader' => $die->PMade,
                'owner' => $die->POwner,
                'made_date' => $die->MakeDate,
                'sample' => $die->CartSample,
                'code' => $die->DesignCode,
                'bgpkg_customer_id' => $new_customer->id ?? null,
                'bgpkg_order_id' => $order->CTNId ?? null,
                'created_by' => null,
                'branch_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $iteration++; // Increment the counter after each loop
        }

        // Write die data to the bgpkg_dies.json file
        $polymerJson = storage_path('app/bgpkg_polymers.json');
        $polymerFile = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_polymers',
            'data' => $polymer,
        ], JSON_PRETTY_PRINT);
        File::put($polymerJson, $polymerFile);

        return response()->json(['success' => 200]);
    }
    public function insertPolymer()
    {
        // Path to the polymer JSON file
        $polymerJsonFilePath = storage_path('app/bgpkg_polymers.json');

        // Check if the file exists
        if (!File::exists($polymerJsonFilePath)) {
            return response()->json(['error' => 'Polymer JSON file not found'], 404);
        }

        // Read and decode the polymer JSON file
        $polymerJson = File::get($polymerJsonFilePath);
        $polymerJsonData = json_decode($polymerJson, true);

        // Validate the JSON structure
        if (!is_array($polymerJsonData) || !isset($polymerJsonData['data'])) {
            return response()->json(['error' => 'Invalid polymer JSON structure'], 400);
        }

        // Insert polymer data into the 'bgpkg_polymers' table
        foreach ($polymerJsonData['data'] as $polymer) {
            // Handle created_at and updated_at, defaulting to current time if not present
            $createdAt = isset($polymer['created_at']) ? Carbon::parse($polymer['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($polymer['updated_at']) ? Carbon::parse($polymer['updated_at'])->format('Y-m-d H:i:s') : now();

            // Insert into the database
            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_polymers`
            (id, number, app, size, status, color, location, mader, owner, made_date, sample, code, bgpkg_customer_id, bgpkg_order_id, created_by, branch_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $polymer['id'],
                $polymer['number'],
                $polymer['app'],  // Iteration or application field
                $polymer['size'],
                $polymer['status'],
                $polymer['color'],
                $polymer['location'],
                $polymer['mader'],
                $polymer['owner'],
                $polymer['made_date'],
                $polymer['sample'],
                $polymer['code'],
                $polymer['bgpkg_customer_id'] ?? null,  // Use null if customer ID is not present
                $polymer['bgpkg_order_id'] ?? null,  // Use null if order ID is not present
                $polymer['created_by'],
                $polymer['branch_id'],
                $createdAt,
                $updatedAt
            ]);
        }

        return response()->json(['message' => 'Polymers inserted successfully!']);
    }

    public function design()
    {
        $designs = DB::table('designinfo')->get();
        $desgined = [];
        $media = [];

        foreach ($designs as $design) {
            $user = DB::table('employeet')->where('EId', $design->designer_id)->first();
            $employee_id = null;

            // Ensure the user exists before trying to fetch the employee data
            if ($user) {
                $employee = DB::table('users')->where('name', $user->EUserName)->first();
                // Use optional chaining to avoid errors if $employee is null
                $employee_id = $employee?->employee_id;
            }

            // Determine status
            $status = match ($design->DesignStatus) {
                'Done' => 'Done',
                'Submit for design', 'Sent for design' => 'New',
                'Submit for Making' => 'Done',
                'Processing' => 'Design Start',
                'Sent For Approval' => 'Sent for Approval',
                'Pending' => 'Design Complete',
                'Reject' => 'Rejected',
                default => 'New',
            };

            // Prepare design data
            $desgined[] = [
                'id' => $design->DesignId,
                'deadline' => $design->Alarmdatetime == "0000-00-00 00:00:00" ? null : $design->Alarmdatetime,
                'start' => $design->DesignStartTime,
                'end' => $design->CompleteTime,
                'code' => $design->DesignCode1,
                'status' => $status,
                'assignee' => $employee_id,
                'designable_id' => $design->CaId,
                'designable_type' => 'App\Models\Bgpkg\BgpkgOrder',
                'comment' => 'The old System Data is here',
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Prepare media data if DesignImage exists
            if ($design->DesignImage) {
                $media[] = [
                    'name' => $design->DesignImage,
                    'file_name' => $design->DesignImage,
                    'mime_type' => 'application/pdf',
                    'path' => storage_path("app/public/bgpkg/designs/{$design->DesignImage}"),
                    'disk' => 'public',
                    'file_hash' => '', // You might need to calculate this
                    'collection' => '', // Fill collection if applicable
                    'size' => 2, // Assuming the size, adjust as needed
                    'mediable_type' => 'App\Models\Bgpkg\BgpkgDesign',
                    'mediable_id' => $design->DesignId
                ];
            }
        }

        // Correctly encode the design data and write to the JSON file
        $designJsonPath = storage_path('app/bgpkg_designs.json');
        $designFile = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_designs',
            'data' => $desgined, // Correctly add the designed data here
        ], JSON_PRETTY_PRINT);
        File::put($designJsonPath, $designFile);

        // Write media data to the JSON file
        $mediaJsonPath = storage_path('app/design_media.json');
        $mediaFile = json_encode([
            'type' => 'table',
            'name' => 'media',
            'data' => $media, // Correctly add the media data here
        ], JSON_PRETTY_PRINT);
        File::put($mediaJsonPath, $mediaFile);

        return response()->json(['success' => 200]);
    }

    public function insertDesign()
    {
        // Paths to the JSON files
        $designJsonFilePath = storage_path('app/bgpkg_designs.json');
        $mediaJsonFilePath = storage_path('app/design_media.json');

        // Check if the files exist
        if (!File::exists($designJsonFilePath) || !File::exists($mediaJsonFilePath)) {
            return response()->json(['error' => 'JSON files not found'], 404);
        }

        // Read and decode the design JSON file
        $designJson = File::get($designJsonFilePath);
        $designJsonData = json_decode($designJson, true);

        // Read and decode the media JSON file
        $mediaJson = File::get($mediaJsonFilePath);
        $mediaJsonData = json_decode($mediaJson, true);

        // Validate JSON structure for design data
        if (!is_array($designJsonData) || !isset($designJsonData['data'])) {
            return response()->json(['error' => 'Invalid design JSON structure'], 400);
        }

        // Validate JSON structure for media data
        if (!is_array($mediaJsonData) || !isset($mediaJsonData['data'])) {
            return response()->json(['error' => 'Invalid media JSON structure'], 400);
        }

        // Insert design data into the 'bgpkg_designs' table
        foreach ($designJsonData['data'] as $design) {
            $createdAt = isset($design['created_at']) ? Carbon::parse($design['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($design['updated_at']) ? Carbon::parse($design['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_designs`
            (id, deadline, start, end, code, status, assignee, designable_id, designable_type, comment, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $design['id'],
                $design['deadline'],
                $design['start'],
                $design['end'],
                $design['code'],
                $design['status'],
                $design['assignee'],
                $design['designable_id'],
                $design['designable_type'],
                $design['comment'],
                $createdAt,
                $updatedAt,
            ]);
        }

        // Insert media data into the 'media' table
        foreach ($mediaJsonData['data'] as $media) {
            DB::insert('INSERT INTO `baheer-group-for-test`.`media`
            (name, file_name, mime_type, path, disk, file_hash, collection, size, mediable_type, mediable_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $media['name'],
                $media['file_name'],
                $media['mime_type'],
                $media['path'],
                $media['disk'],
                $media['file_hash'],
                $media['collection'],
                $media['size'],
                $media['mediable_type'],
                $media['mediable_id'],
            ]);
        }

        return response()->json(['message' => 'Designs and associated media inserted successfully!']);
    }
    public function job()
    {
        // Fetch all cartons with valid JobNo and status filtering
        $cartons = DB::table('carton')
            ->whereNotNull('JobNo')
            ->whereNotIn('CTNStatus', ['OnlyProduct', 'Disable', 'Dconfirm', 'Deactive'])
            ->get();

        $jobData = [];
        $historyData = [];

        foreach ($cartons as $carton) {
            // Generate the job number
            $jobNumber = 'BGPKG' . $carton->JobNo;

            // Map status and location based on CTNStatus
            $statusLocationMap = [
                'Archive' => ['status' => 'new', 'location' => 'archive'],
                'Completed' => ['status' => 'completed', 'location' => 'complete'],
                'New' => ['status' => 'new', 'location' => 'finance'],
                'Cancel' => ['status' => 'rejected', 'location' => 'cancel'],
                'Production Process' => ['status' => 'process', 'location' => 'production process'],
                'Printing' => ['status' => 'new', 'location' => 'printing press'],
                'DesignProcess' => ['status' => 'process', 'location' => 'Design'],
                'Fconfirm' => ['status' => 'new', 'location' => 'film'],
                'Production Pending' => ['status' => 'process', 'location' => 'printing press'],
                'Production' => ['status' => 'new', 'location' => 'production new'],
                'Pospond' => ['status' => 'postponed', 'location' => 'film'],
                'Design' => ['status' => 'new', 'location' => 'Design'],
                'Film' => ['status' => 'new', 'location' => 'film'],
            ];

            // Default to new/finance if status not in the map
            $status = $statusLocationMap[$carton->CTNStatus]['status'] ?? 'new';
            $location = $statusLocationMap[$carton->CTNStatus]['location'] ?? 'finance';

            // Determine job type
            $type = $carton->JobType === 'Normal' ? 'Normal' : 'Urgent';

            // Build job data array
            $jobData[] = [
                'id' => $carton->CTNId,
                'job_number' => $jobNumber,
                'status' => $status,
                'location' => $location,
                'old_status' => $carton->CTNStatus,
                'type' => $type,
                'deadline' => null,
                'operation' => null,
                'bgpkg_order_id' => $carton->CTNId,
                'branch_id' => 1,
                'plan_status' => 'new',
                'produced_quantity' => 0,
                'created_at' => $carton->job_order_date ?? now(),
                'updated_at' => now(),
            ];

            // Fetch history for each carton
            $histories = DB::table('cartoncomment')->where('CartonId1', $carton->CTNId)->get();

            foreach ($histories as $item) {
                // Fetch user details
                $user = DB::table('employeet')->where('EId', $item->EmpId1)->first();
                $employee_id = null;

                // Ensure the user exists before trying to fetch the employee data
                if ($user) {
                    $employee = DB::table('users')->where('name', $user->EUserName)->first();
                    $employee_id = $employee?->employee_id; // Safe navigation
                }
                $itemType = '';
                if ($item->ComDepartment == 'Finance') {
                    $itemType = 'finance';
                } else if ($item->ComDepartment == 'Design') {
                    $itemType = 'Design';
                } else if ($item->ComDepartment == 'Archive') {
                    $itemType = 'archive';
                } else if ($item->ComDepartment == 'Printing') {
                    $itemType = 'printing press';
                }
                // Build history data array
                $historyData[] = [
                    'bgpkg_job_id' => $carton->CTNId,
                    'status' => $status,
                    'location' => $itemType,
                    'entered_at' => $item->ComDate,
                    'exited_at' => $item->EndDate,
                    'created_by' => $employee_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Write job data to the bgpkg_jobs.json file
        $jobJsonPath = storage_path('app/bgpkg_jobs.json');
        $jobJsonContent = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_jobs',
            'data' => $jobData,
        ], JSON_PRETTY_PRINT);
        File::put($jobJsonPath, $jobJsonContent);

        // Write history data to the bgpkg_job_histories.json file
        $historyJsonPath = storage_path('app/bgpkg_job_histories.json');
        $historyJsonContent = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_job_histories',
            'data' => $historyData,
        ], JSON_PRETTY_PRINT);
        File::put($historyJsonPath, $historyJsonContent);

        return response()->json(['success' => 200]);
    }
    public function insertJob()
    {
        // Paths to the JSON files
        $jobJsonFilePath = storage_path('app/bgpkg_jobs.json');
        $historyJsonFilePath = storage_path('app/bgpkg_job_histories.json');

        // Check if the files exist
        if (!File::exists($jobJsonFilePath) || !File::exists($historyJsonFilePath)) {
            return response()->json(['error' => 'JSON files not found'], 404);
        }

        // Read and decode the job JSON file
        $jobJson = File::get($jobJsonFilePath);
        $jobData = json_decode($jobJson, true);

        // Read and decode the history JSON file
        $historyJson = File::get($historyJsonFilePath);
        $historyData = json_decode($historyJson, true);

        // Validate JSON structure for job data
        if (!is_array($jobData) || !isset($jobData['data'])) {
            return response()->json(['error' => 'Invalid job JSON structure'], 400);
        }

        // Validate JSON structure for history data
        if (!is_array($historyData) || !isset($historyData['data'])) {
            return response()->json(['error' => 'Invalid history JSON structure'], 400);
        }

        // Insert job data into the 'bgpkg_jobs' table
        foreach ($jobData['data'] as $job) {
            $createdAt = isset($job['created_at']) ? Carbon::parse($job['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($job['updated_at']) ? Carbon::parse($job['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_jobs`
            (id, job_number, status, location, old_status, type, deadline, operation, bgpkg_order_id, branch_id, plan_status, produced_quantity, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $job['id'],
                $job['job_number'],
                $job['status'],
                $job['location'],
                $job['old_status'],
                $job['type'],
                $job['deadline'],
                $job['operation'],
                $job['bgpkg_order_id'],
                $job['branch_id'],
                $job['plan_status'],
                $job['produced_quantity'],
                $createdAt,
                $updatedAt,
            ]);
        }

        // Insert history data into the 'bgpkg_job_histories' table
        foreach ($historyData['data'] as $history) {
            $createdAt = isset($history['created_at']) ? Carbon::parse($history['created_at'])->format('Y-m-d H:i:s') : now();
            $updatedAt = isset($history['updated_at']) ? Carbon::parse($history['updated_at'])->format('Y-m-d H:i:s') : now();

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_job_histories`
            (bgpkg_job_id, status, location, entered_at, exited_at, created_by, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
                $history['bgpkg_job_id'],
                $history['status'],
                $history['location'],
                $history['entered_at'],
                $history['exited_at'],
                $history['created_by'],
                $createdAt,
                $updatedAt,
            ]);
        }

        return response()->json(['message' => 'Jobs and histories inserted successfully!']);
    }
    public function machine()
    {
        $machines = DB::table('machine')->get();
        $machineData = [];

        foreach ($machines as $machine) {

            $machineData[] = [
                'id' => $machine->machine_id,
                'name' => $machine->machine_name,
                'short_name' => $machine->machine_name_pashto ?? '3PLY',
                'machine_type' => 'Carrugation',
                'machine_size' => 50,
                'machine_capacity' => $machine->capacity ?? 5,
                'unit_id' => 2,
                'created_by' => 1190,
                'created_at' =>  now(),
                'updated_at' => now(),
            ];
        }
        $machineJson = storage_path('app/bgpkg_machines.json');
        $machineData = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_machines',
            'data' => $machineData,
        ], JSON_PRETTY_PRINT);
        File::put($machineJson, $machineData);

        return response()->json(['success' => 200]);
    }
    public function insertMachine()
    {

        $machineJsonFilePath = storage_path('app/bgpkg_machines.json');
        if (!File::exists($machineJsonFilePath)) {
            return response()->json(['error' => 'JSON file not found'], 404);
        }

        $machineJson = File::get($machineJsonFilePath);
        $machineData = json_decode($machineJson, true);

        if (!is_array($machineData) || !isset($machineData['data'])) {
            return response()->json(['error' => 'Invalid machine JSON structure'], 400);
        }

        // Insert machine data into the 'machines' table
        foreach ($machineData['data'] as $machine) {
            // Convert created_at and updated_at to the MySQL format
            $createdAt = Carbon::parse($machine['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($machine['updated_at'])->format('Y-m-d H:i:s');

            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_machines`
            (id, name, short_name, machine_type, machine_size, machine_capacity, unit_id, created_by, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $machine['id'],
                $machine['name'],
                $machine['short_name'],
                $machine['machine_type'],
                $machine['machine_size'],
                $machine['machine_capacity'],
                $machine['unit_id'],
                $machine['created_by'],
                $createdAt,  // Use formatted date
                $updatedAt,  // Use formatted date
            ]);
        }

        return response()->json(['message' => 'Machines inserted successfully!']);
    }
    public function jobPolymer()
    {
        $designs = DB::table('designinfo')->whereNotNull('film_start_date')->get();
        $desgined = [];

        foreach ($designs as $design) {
            $employee_id = 110;

            // Determine status
            $status = match ($design->DesignStatus) {
                null => 'New',
                'Complete' => 'Done',
                'Assigned' => 'Assigned',
                'Done' => 'Done', // Added 'Done' case
                default => 'New',  // Fallback for unhandled statuses
            };
            $bgpkgJob = DB::table('baheer-group-for-test.bgpkg_jobs')->where('id', $design->CaId)->first();
            if (!$bgpkgJob) {
                continue;
            }
            // Prepare design data
            $desgined[] = [
                'id' => $design->DesignId,
                'start' => $design->film_start_date,
                'end' => $design->film_complete_date ?? now(),
                'status' => $status,
                'assignee' => $employee_id,
                'bgpkg_job_id' => $bgpkgJob->id,
                'bgpkg_polymer_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Correctly encode the design data and write to the JSON file
        $designJsonPath = storage_path('app/bgpkg_job_polymers.json');
        $designFile = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_job_polymers',
            'data' => $desgined, // Correctly add the designed data here
        ], JSON_PRETTY_PRINT);
        File::put($designJsonPath, $designFile);

        return response()->json(['success' => 200]);
    }
    public function insertJobPolymer()
    {
        // Path to the job polymers JSON file
        $jobPolymerJsonFilePath = storage_path('app/bgpkg_job_polymers.json');

        // Check if the JSON file exists
        if (!File::exists($jobPolymerJsonFilePath)) {
            return response()->json(['error' => 'JSON file not found'], 404);
        }

        // Read and decode the job polymer JSON file
        $jobPolymerJson = File::get($jobPolymerJsonFilePath);
        $jobPolymerData = json_decode($jobPolymerJson, true);

        // Validate the JSON structure
        if (!is_array($jobPolymerData) || !isset($jobPolymerData['data'])) {
            return response()->json(['error' => 'Invalid job polymer JSON structure'], 400);
        }

        // Insert job polymer data into the 'bgpkg_job_polymers' table
        foreach ($jobPolymerData['data'] as $polymer) {
            // Convert the dates to MySQL's datetime format
            $start = Carbon::parse($polymer['start'])->format('Y-m-d H:i:s');
            $end = Carbon::parse($polymer['end'])->format('Y-m-d H:i:s');
            $createdAt = Carbon::parse($polymer['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($polymer['updated_at'])->format('Y-m-d H:i:s');
            // Insert the data into the database
            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_job_polymers`
            (id, start, end, status, assignee, bgpkg_job_id, bgpkg_polymer_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $polymer['id'],
                $start,
                $end,
                $polymer['status'],
                $polymer['assignee'],
                $polymer['bgpkg_job_id'],
                $polymer['bgpkg_polymer_id'],
                $createdAt,
                $updatedAt,
            ]);
        }

        return response()->json(['message' => 'Job polymers inserted successfully!']);
    }
    public function productionCycle()
    {
        $productionCycle = [];
        $productions = DB::table('production_cycle')->get();

        foreach ($productions as $product) {
            $bgpkgJob = DB::table('baheer-group-for-test.bgpkg_jobs')->where('id', $product->CTNId)->first();
            $employee_id = 13;
            if ($product->created_by) {
                $user = DB::table('employeet')->where('EId', $product->created_by)->first();
                $employee = DB::table('baheer-group-for-test.users')->where('name', $user->EUserName)->first();
                if ($employee) {
                    $employee_id = $employee->employee_id;
                } else {
                    $employee_id = 13;
                }
            } else {
                $employee_id = 13;
            }


            if (!$bgpkgJob) {
                continue;
            }
            $status = match ($product->cycle_status) {
                'Completed' => 'Complete',
                'Incomplete' => 'New',
                'Task List' => 'In Progress',
                'Finish List' => 'Submitted',
                default => 'New',
            };
            $productionCycle[] = [
                'id' => $product->cycle_id,
                'bgpkg_job_id' => $bgpkgJob->id,
                'plan_quantity' => $product->cycle_plan_qty ??  0,
                'produced' => $product->cycle_produce_qty ?? 0,
                'flute_type' => $product->cycle_flute_type ?? 'B',
                'status' => $status,
                'created_by' => $employee_id,
                'created_at' => $product->page_arrival_time,
                'updated_at' => $product->cycle_date
            ];
        }
        $orderJson = storage_path('app/bgpkg_production_cycles.json');
        $orderJsonData = json_encode([
            'type' => 'table',
            'name' => 'bgpkg_production_cycles',
            'data' => $productionCycle,
        ], JSON_PRETTY_PRINT);
        File::put($orderJson, $orderJsonData);

        return response()->json(['success' => 200]);
    }
    public function insertProductionCycle()
    {
        // Path to the production cycle JSON file
        $productionCycleJsonFilePath = storage_path('app/bgpkg_production_cycles.json');

        // Check if the JSON file exists
        if (!File::exists($productionCycleJsonFilePath)) {
            return response()->json(['error' => 'JSON file not found'], 404);
        }

        // Read and decode the production cycle JSON file
        $productionCycleJson = File::get($productionCycleJsonFilePath);
        $productionCycleData = json_decode($productionCycleJson, true);

        // Validate the JSON structure
        if (!is_array($productionCycleData) || !isset($productionCycleData['data'])) {
            return response()->json(['error' => 'Invalid production cycle JSON structure'], 400);
        }

        // Insert production cycle data into the 'bgpkg_production_cycles' table
        foreach ($productionCycleData['data'] as $cycle) {
            // Convert created_at and updated_at to MySQL datetime format
            $createdAt = Carbon::parse($cycle['created_at'])->format('Y-m-d H:i:s');
            $updatedAt = Carbon::parse($cycle['updated_at'])->format('Y-m-d H:i:s');

            // Insert data into the database
            DB::insert('INSERT INTO `baheer-group-for-test`.`bgpkg_production_cycles`
            (id, bgpkg_job_id, plan_quantity, produced, flute_type, status, created_by, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $cycle['id'],
                $cycle['bgpkg_job_id'],
                $cycle['plan_quantity'],
                $cycle['produced'],
                $cycle['flute_type'],
                $cycle['status'],
                $cycle['created_by'],
                $createdAt,
                $updatedAt,
            ]);
        }

        return response()->json(['message' => 'Production cycles inserted successfully!']);
    }
}
