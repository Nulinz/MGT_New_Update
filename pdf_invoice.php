<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice No</title>

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
                        <span>Tax Invoice</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%">
                        <div style="display: flex; align-items:center; justify-content: space-between; width: 80%">
                            <div style="width: 45%">
                                <h6>Invoice Date</h6>
                                <h6>Invoice No</h6>
                                <h6>Created By</h6>
                            </div>
                            <div style="width: 5%">
                                <h6>:</h6>
                                <h6>:</h6>
                            </div>
                            <div style="width: 45%">
                                <h6>12-12-2024</h6>
                                <h6>NUZ/00123/24-25</h6>
                                <h6>Sheik</h6>
                            </div>
                        </div>
                        <div style="width: 20%">
                            <img src="./qrcodes/" height="75px" alt="">
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
                        <th style="border-right: 1px solid #000">Invoice From</th>
                        <th>Invoice To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border-right: 1px solid #000"><b>Nulinz Technology</b><br> NULINZ EDUCATION PRIVATE
                            LIMITED <br>1st Floor, NV Arcade Building, Near 5 Roads, Next Reliance Mall,
                            Salem-636004.<br> +91 90033 00571 | nulinz.official@gmail.com | www.nulinz.com</td>
                        <td><b>Expert Corporate Solutions</b><br>
                            Sriperumbudur, Chennai, Tamilnadu - 600028. <br> +91 78945 61230 | expert@gmail.com.
                            <br> <b>GST: GST123456789</b></td>
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
                    <tr>
                        <td style="border-right: 1px solid #000;">1</td>
                        <td style="border-right: 1px solid #000;"><b>Description 1</b><br>
                            Description 2</td>
                        <td style="border-right: 1px solid #000;">1</td>
                        <td style="border-right: 1px solid #000;">1</td>
                        <td style="border-right: 1px solid #000;">1</td>
                        <td style="border-right: 1px solid #000;">1</td>
                        <td>1</td>
                    </tr>
                    <tr style="background-color: #0989D4; color: #fff;">
                        <th colspan="6" style="font-weight: 600; border-right: 1px solid #000; text-align:right">Taxable
                            Value</th>
                        <th style="font-weight: 600;">1</th>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid #000"></td>
                        <th style="border-right: 1px solid #000"></th>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000">CGST</td>
                        <td style="border-right: 1px solid #000">9%</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td style="border-right: 1px solid #000"></td>
                        <th style="border-right: 1px solid #000"></th>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000"></td>
                        <td style="border-right: 1px solid #000">SGST</td>
                        <td style="border-right: 1px solid #000">9%</td>
                        <td>1</td>
                    </tr>
                    <tr style="background-color: #0989D4; color: #fff;">
                        <th colspan="6" style="font-weight: 600; border-right: 1px solid #000; text-align:right">Total
                            Invoice Value</th>
                        <th style="font-weight: 600;">1</th>
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
                    <tr>
                        <td style="width: 10%; text-align: center; border-right: 1px solid #000;">
                            1</td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">1
                        </td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">9%</td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">1
                        </td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">9%</td>
                        <td style="width: 15%; text-align: center; border-right: 1px solid #000;">1
                        </td>
                        <td style="width: 15%; text-align: center;">1</td>
                    </tr>
                    <tr style="background-color: #0989D4; color: #fff;">
                        <th colspan="6" style="font-weight: 600; border-right: 1px solid #000">Tax Total</th>
                        <th style="font-weight: 600; text-align: center;">1</th>
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
                    <!--<div class="payment">-->
                    <!--    <span>Payment QR Code</span>-->
                    <!--</div>-->
                    <!--<div class="payment1">-->
                    <!--    <div class="upiid">-->
                    <!--        <p>UPI Id: Varalaxmi@citi</p>-->
                    <!--        <div class="upiimg">-->
                    <!--            <img src="./image/phonepe.jpg" height="25px" alt="">-->
                    <!--            <img src="./image/gpay.webp" height="25px" alt="">-->
                    <!--            <img src="./image/paytm.png" height="40px" alt="">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="qr">-->
                    <!--        <img src="./image/qr.webp" height="80px" alt="">-->
                    <!--    </div>-->
                    <!--</div>-->
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
                            <td>₹ 1000000</td>
                        </tr>
                        <tr>
                            <td><b>Total amount in words</b></td>
                            <td>:</td>
                            <td>One Crore</td>
                        </tr>
                        <tr>
                            <td><b>Authorised Signature</b></td>
                            <td>:</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <span style="font-size: 13px;">No signature required - electronically generated invoice.</span>
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