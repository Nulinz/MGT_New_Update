<?php
include('fetch.php');
if(isset($_GET['quot'],$_GET['type'])){

    $type = $_GET['type'];

    if($type=="quot"){
        $tbl='m_quot';
        $ct = 'quot';
        $bill_name = 'Quotation';
    }else{
        $tbl='m_inv';
        $ct = 'inv';
        $bill_name = 'Invoice';
    }


    $q_id = $_GET['quot'];

    $con = $db->link();

    $select_qid1 = "select * from `$tbl` where `id`='$q_id'";
    $query_qid1 = mysqli_query($con,$select_qid1);
    $data_qid1 = mysqli_fetch_assoc($query_qid1);

        $q_date = date("d-m-Y",strtotime($data_qid1['c_on']));

        $q_no = $data_qid1['id'];

        $f_id = $data_qid1['f_id'];

        $created = $data_qid1['c_by'];

        $cr_emp = $fetch->table_list_id('m_emp','id',$created);
        $pro_det = $fetch->table_list_id('m_pro','id',$f_id);
        $cmp_det = $fetch->table_list_id('m_cmp','id',$pro_det['c_id']);
        $cmp_det1 = $fetch->table_list_id('m_cmp2','f_id',$f_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $bill_name; ?> No: <?php echo $q_id; ?> <?php echo $ser_title; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" sizes="32*32" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="./css/invoice.css">

</head>

<body>
    <section class="overall">

        <!-- header -->
        <div class="header">
            <div class="headerdiv1">
                <div class="logo">
                    <img src="./images/pdf_logo.png" height="50px" alt="">
                </div>
                <div class="companydt">
                    <h6 id="companytitle">Nulinz Technology</h6>
                    <h6 id="companyaddress">NULINZ EDUCATION PRIVATE LIMITED</h6>
                    <h6 id="companyaddress">233/1, Balaji Nagar,Mettur Dam, Salem<br>Tamilnadu - 636402.</h6>
                    <h6 id="companyaddress"><b>PAN:</b> &nbsp; AAGCN3356H</h6>
                    <h6 id="companyaddress"><b>CIN:</b> &nbsp; U74999TZ2018PTC031419</h6>
                </div>
            </div>
            <div class="headerdiv2">
                <div class="headerct">
                    <div class="invhead">
                        <span><?php echo $bill_name; ?></span>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%">
                        <div style="display: flex; align-items:center; justify-content: space-between; width: 80%">
                            <div style="width: 45%">
                                <h6><?php echo $bill_name; ?> Date</h6>
                                <h6><?php echo $bill_name; ?> No</h6>
                                <h6>Created By</h6>
                            </div>
                            <div style="width: 5%">
                                <h6>:</h6>
                                <h6>:</h6>
                            </div>
                            <div style="width: 45%">
                                <h6><?php echo $q_date; ?></h6>
                                <h6>00<?php echo $q_no; ?> 25/26</h6>
                                <h6><?php echo $cr_emp['name']; ?></h6>
                            </div>
                        </div>
                        <div style="width: 20%">
                            <img src="./qrcodes/pdf_qr.png" height="75px" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- cmpnytable -->
        <div class="cmpnytable">
            <table>
                <thead>
                    <tr>
                        <th style="border-right: 1px solid #000"><?php echo $bill_name; ?> By</th>
                        <th><?php echo $bill_name; ?> To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border-right: 1px solid #000"><b>Nulinz Technology</b><br> NULINZ EDUCATION PRIVATE
                            LIMITED <br>1st Floor, NV Arcade Building, Near 5 Roads, Next Reliance Mall,
                            Salem-636004.<br> +91 90033 00571 | nulinz.official@gmail.com | www.nulinz.com</td>
                        <td><b><?php echo strtoupper($cmp_det['c_name']); ?></b><br> <?php echo $cmp_det['address'].",".$cmp_det['dis'].", ".$cmp_det['state']." ,".$cmp_det['pin']." ,".$cmp_det['contact'].", ".$cmp_det['mail'].", "; ?> . <br> <b>GST:</b> <b><?php echo $cmp_det['gst']; ?></b>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Bill Content -->
        <div class="billtable">
            <table class="table1">
                <thead>
                    <th style="border-right: 1px solid #000; width: 5%;">#</th>
                    <th style="border-right: 1px solid #000; width: 30%;">DESCRIPTION</th>
                    <th style="border-right: 1px solid #000; width: 10%;">HSN/SAC</th>
                    <th style="border-right: 1px solid #000; width: 10%;">QUANTITY</th>
                    <th style="border-right: 1px solid #000; width: 10%;">GST</th>
                    <th style="border-right: 1px solid #000; width: 10%;">RATE</th>
                    <th style="width: 10%;">AMOUNT</th>
                </thead>
                <tbody>
                <?php
                    $select_qid = "select * from `e_quot` where `f_id`='$q_id' and `cat`='$ct'";
                    $query_qid = mysqli_query($con,$select_qid);
                    $gst_cost1=0;$over1=0;$i=1;
                    while($data_qid = mysqli_fetch_assoc($query_qid)){

                    $ser_id = $data_qid['ser'];

                    $s_ser = "select * from `m_service` where `id`='$ser_id'";
                    $q_ser = mysqli_query($con,$s_ser);
                    $d_ser = mysqli_fetch_assoc($q_ser);

                    $ser_title = $d_ser['ser_name'];
                    $ser_hsn = $d_ser['hsn'];
                    $ser_gst = $d_ser['gst'];

                    // $des = $data_qid['des'];
                    $quan = $data_qid['qty'];
                    $cost = $data_qid['cost'];
                    ?>
                    <tr>
                        <td style="border-right: 1px solid #000;"><?php echo $i; ?></td>
                        <td style="border-right: 1px solid #000;"><?php echo $data_qid['des']; ?><br><b><?php echo $ser_title; ?></b>
                       </td>
                        <td style="border-right: 1px solid #000;"><?php echo $ser_hsn; ?></td>
                        <td style="border-right: 1px solid #000;"><?php echo $quan; ?></td>
                        <td style="border-right: 1px solid #000;"><?php echo $ser_gst."%"; ?></td>
                        <td style="border-right: 1px solid #000;"><?php echo $cost; ?></td>
                        <td><?php echo $over = $quan*$cost; $over1=$over1+$over; ?></td>
                    </tr>
                    <?php
                     $gst_cost = ($cost*($ser_gst/100))*$quan;
                     $gst_cost1 = $gst_cost+$gst_cost1;
                     $i++;
                    }
                    $nine = round(($gst_cost1/2),2);
                    ?>
                    <tr style="background-color: #0989D4; color: #fff;">
                        <th colspan="6" style="font-weight: 600; border-right: 1px solid #000;text-align:right">Non
                            Taxable Total</th>
                        <th style="font-weight: 600;"><?php echo $over1; ?></th>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid #000"></td>
                        <th style="border-right: 1px solid #000"></th>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000">CGST</td>
                        <td style="border-right: 1px solid #000">9%</td>
                        <td><?php echo $cg = $nine; ?></td>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid #000"></td>
                        <th style="border-right: 1px solid #000"></th>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000">SGST</td>
                        <td style="border-right: 1px solid #000">9%</td>
                        <td><?php echo $sg = $nine; ?></td>
                    </tr>
                    <tr style="background-color: #0989D4; color: #fff;">
                        <th colspan="6" style="font-weight: 600; border-right: 1px solid #000; text-align:right">Taxable
                            Total</th>
                        <th style="font-weight: 600;"><?php echo $over_total = $over1+$cg+$sg; ?></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total Bill Content -->
        <div class="billtable" style="margin-top: 10px">
            <table class="table2">
                <thead>
                    <tr>
                        <th style="text-align: center; border-right: 1px solid #000;">HSN/<br>SAC</th>
                        <th style="text-align: center; border-right: 1px solid #000;">Taxable Value</th>
                        <th colspan="2"
                            style="text-align: center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                            Central Tax</th>
                        <th colspan="2"
                            style="text-align: center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                            State Tax</th>
                        <th style="text-align: center;">Total Tax Amount</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; border-right: 1px solid #000;"></th>
                        <th style="text-align: center; border-right: 1px solid #000;"></th>
                        <th style="text-align: center; border-right: 1px solid #000;">Rate</th>
                        <th style="text-align: center; border-right: 1px solid #000;">Amount</th>
                        <th style="text-align: center; border-right: 1px solid #000;">Rate</th>
                        <th style="text-align: center; border-right: 1px solid #000;">Amount</th>
                        <th style="text-align: center;"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                     $select_tk = "SELECT s.hsn, SUM(q.qty * q.cost) AS total_cost, SUM(q.qty * (q.cost * (s.gst / 100))) AS total_gst
                      FROM `e_quot` q
                      JOIN `m_service` s ON q.ser = s.id
                      WHERE q.f_id='$q_id' AND q.cat='$ct'
                      GROUP BY s.hsn";
                        $query_tk = mysqli_query($con, $select_tk);
                        $tk_total1 = 0;

                        while($data_tk = mysqli_fetch_assoc($query_tk)){
                            $ser_hsn_tk = $data_tk['hsn'];



                            $total_cost = ($data_tk['total_cost']);
                            $total_gst = $data_tk['total_gst'];




                            $cg_tk = round($total_gst / 2, 2);
                            $sg_tk = round($total_gst / 2, 2);
                            $tk_total = $cg_tk + $sg_tk;
                            $tk_total1 += $tk_total;

                            $tax_val = $total_cost+$total_gst;


                    ?>
                    <tr>
                        <td style="width: 10%; text-align: center; border-right: 1px solid #000;">
                        <?php echo $ser_hsn_tk; ?></td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">
                        <?php echo $tax_val; ?></td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">9%</td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;"><?php echo $cg_tk; ?>
                        </td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">9%</td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;"><?php echo $sg_tk; ?>
                        </td>
                        <td style="width: 15%; text-align: center;"><?php echo $tk_total = $cg_tk+$sg_tk; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr style="background-color: #0989D4; color: #fff;">
                        <th colspan="6" style="font-weight: 600; border-right: 1px solid #000">Tax Total</th>
                        <th style="font-weight: 600; text-align: center;"><?php echo $tk_total1; ?></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footerdiv1">
                <div class="footerdiv0">
                    <div class="span2">
                        <span>Company Details</span>
                    </div>
                    <div
                        style="display: grid; grid-template-columns: 70% 30%; align-items:center; justify-content: space-between; width: 100%">
                        <div style="display: flex; align-items:center; justify-content: space-between; width: 100%">
                            <div style="width: 40%">
                                <h6 style="margin: 0px 0px 2px 0px">Name</h6>
                                <h6 style="margin: 0px 0px 2px 0px">Bank Name</h6>
                                <h6 style="margin: 0px 0px 2px 0px">A/C Number</h6>
                                <h6 style="margin: 0px 0px 2px 0px">IFSC Code</h6>
                                <h6 style="margin: 0px 0px 2px 0px">GST</h6>
                                <h6 style="margin: 0px 0px 2px 0px">TAN</h6>
                                <h6 style="margin: 0px 0px 2px 0px">MSME</h6>
                            </div>
                            <div style="width: 2%">
                                <h6 style="margin: 0px 0px 2px 0px">:</h6>
                                <h6 style="margin: 0px 0px 2px 0px">:</h6>
                                <h6 style="margin: 0px 0px 2px 0px">:</h6>
                                <h6 style="margin: 0px 0px 2px 0px">:</h6>
                                <h6 style="margin: 0px 0px 2px 0px">:</h6>
                                <h6 style="margin: 0px 0px 2px 0px">:</h6>
                            </div>
                            <div style="width: 55%">
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;">NULINZ EDUCATION PRIVATE LIMITED
                                </h6>
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;">IDFC First Bank</h6>
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;">10062833639</h6>
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;">IDFB0080591</h6>
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;"><b>33AAGCN3356H1ZJ</b></h6>
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;">CHEN10972D</h6>
                                <h6 style="margin: 0px 0px 2px 0px; font-weight: 500;">UDYAM-TN-20-0136190</h6>
                            </div>
                        </div>
                        <div class="qr" style="display: flex; align-items:center; justify-content: end; width: 100%">
                            <div>
                                <h6>Scan & Pay</h6>
                                <img src="./images/pdf_qr.png" height="80px" style="display: flex; margin: auto" alt="">
                                <h6>UPI ID: 9003300571@ptaxis</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerdiv2">
                <table>
                    <tbody>
                        <tr>
                            <!--<td>GST @18%</td>-->
                        </tr>
                        <tr>
                            <td><b>Total Amount</b></td>
                            <td>:</td>
                            <td>₹ <?php echo $over_total; ?></td>
                        </tr>
                        <tr>
                            <td><b>Total amount in words</b></td>
                            <td>:</td>
                            <td><?php echo $fetch->money($over_total); ?></td>
                        </tr>


                    </tbody>
                </table>
                <span style="font-size: 12px;">No signature required - electronically generated invoice.</span>
            </div>
        </div>

        <div class="termsncondition">
            <h3>Terms And Condition</h3>
            <ul>
                <li>A concerned business owner will be responsible for all the details and content provided by
                    him.</li>
                <li>In case of any changes or correction in Product or service extra charges are applicable.
                </li>
                <li>Annual maintenance charges (AMC) are applicable including Server,Domain.</li>
                <li>Remaining payment must be made in full during the product /services delivered.</li>
                <li>Amount paid are not returnable/refundable or transferable.</li>
            </ul>
        </div>
    </section>
</body>

</html>