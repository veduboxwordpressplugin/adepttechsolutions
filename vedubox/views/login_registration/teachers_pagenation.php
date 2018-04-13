<?php
  
    /************************************************************\
    *
    *	  PHP Array Pagination Copyright 2007 - Derek Harvey
    *	  www.lotsofcode.com
    *
    *	  This file is part of PHP Array Pagination .
    *
    *	  PHP Array Pagination is free software; you can redistribute it and/or modify
    *	  it under the terms of the GNU General Public License as published by
    *	  the Free Software Foundation; either version 2 of the License, or
    *	  (at your option) any later version.
    *
    *	  PHP Array Pagination is distributed in the hope that it will be useful,
    *	  but WITHOUT ANY WARRANTY; without even the implied warranty of
    *	  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
    *	  GNU General Public License for more details.
    *
    *	  You should have received a copy of the GNU General Public License
    *	  along with PHP Array Pagination ; if not, write to the Free Software
    *	  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA	02111-1307	USA
    *
    \************************************************************/
    
?><?php 
  
  function callAPI($method, $url, $data = false)
{
    if(empty($url)) throw new Exception('URL missing');	
    $curl = curl_init();

    switch ($method)
    {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);

            if (!empty($data))
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT'); 
		
            if (!empty($data))
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));		
	    break;
        case 'GET':
            if (!empty($data))
                $url = sprintf('%s?%s', $url, http_build_query($data));
	    break;
        default: throw new Exception('Unsupported method: ' . $method); 
    }
  
    // Exchange format - JSON
    $headers = array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, 'username:password');

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    return curl_exec($curl);
}

$response = callAPI('GET', 'http://demo.vedubox.net/API/api/packageDetail/getPackageDetailsForPackageDetailList?url=http://demo.vedubox.net');

$response = json_decode($response);
$inner_arrays = $response->packageDetails;

/* echo '<pre>';
//print_r($inner_arrays);
echo '</pre>'; */
  
  ?><h1>PHP Array Pagination</h1>
    <hr  /><?php

        ini_set('display_errors','On');
        error_reporting(E_ALL);

        // Include the pagination class		
		include_once(TSCORE_PLUGIN_PATH.'classes/paginationclass.php');		
		
		foreach ($inner_arrays as $value) {
          $products[] = array(
            'Name' => $value->title,
            'Amount' => $value->amount,
          );
        } 

        // If we have an array with items
         if (count($products)) {
          // Create the pagination object
          $pagination = new pagination($products, (isset($_GET['page']) ? $_GET['page'] : 1), 10);
          // Decide if the first and last links should show
          $pagination->setShowFirstAndLast(false);
          // You can overwrite the default seperator
          $pagination->setMainSeperator(' | ');
          // Parse through the pagination class
          $productPages = $pagination->getResults();
          // If we have items 
          if (count($productPages) != 0) {
            // Create the page numbers
            echo $pageNumbers = '<div class="numbers">'.$pagination->getLinks($_GET).'</div>';
            // Loop through all the items in the array
            foreach ($productPages as $productArray) {
              // Show the information about the item
              echo '<p><b>'.$productArray['Name'].'</b> &nbsp; &pound;'.$productArray['Amount'].'</p>';
            }
            // print out the page numbers beneath the results
            echo $pageNumbers;
          }
        } 
      ?><p><a href="http://www.lotsofcode.com/php/projects/php-array-pagination" target="_blank">PHP Array Pagination</a> provided by <a href="http://www.lotsofcode.com/" target="_blank">Lots of Code</a></p>
 