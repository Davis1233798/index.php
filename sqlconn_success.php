
<?   
   $ServerName = "192.168.1.141";
   $connectionInfo = Array("Database"=>"osundb_test","UID"=>"osun","PWD"=>"osun000","CharacterSet"=>"UTF-8");
   $conn = sqlsrv_connect($ServerName,$connectionInfo);
   $query = "select PostMailNum ,Unicode from barcode_time where arrivaldate > '100.12.20' ";
   $stmt1 = sqlsrv_query($conn,$query);
   while($order = sqlsrv_fetch_object($stmt1)){
      $num =  $order->PostMailNum ;
      $unicode = $order->Unicode;

      $client = new SoapClient("http://sprws.post.gov.tw/PSTTP_MailQuery.asmx?WSDL");
      
      $params = array("MAIL_NO" => $num);
      $result = $client->MailQueryNewStatus($params)->MailQueryNewStatusResult;
      //echo $result;
      $stat = $result->Item;
    
      $update = "update barcode_time set Stat = '.$stat.' WHERE unicode = '.$unicode.'";
      $stmt1 = sqlsrv_query($conn,$update);
       if ($stmt1) {  
         echo "Row successfully updated.\n";  
	   } else {  
         echo "Row updated failed.\n";  
      die(print_r(sqlsrv_errors(), true));  
	   }  
   }


?>  
<script type="text/javascript"> 
window.close(); 
</script> 