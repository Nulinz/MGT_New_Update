<div class="row">
    <table class="table">
        <tbody class="border-0">
            <?php
                $pro = $tk_det['pro_id'];
                $pro_det = $fetch->table_list_id('m_pro','id',$pro);

                $cmp = $fetch->table_list_id('m_cmp','id',$pro_det['c_id']);

                $tech = json_decode($pro_det['tech']);
                $agree = json_decode($pro_det['agree']);
                $plat = json_decode($pro_det['plat_form']);
            ?>
            <tr>
                <td class="lefthead">Project Title</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['title']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Company</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $cmp['c_name']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Lead Type</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['lead']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Service Type</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['service']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">E-Commerce</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['e_com']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">No. Of People</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['no_user']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Roles</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['roles']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Purpose</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['purpose']; ?></td>

            </tr>
            <tr>
                <td class="lefthead">Contact</td>
                <td>:</td>
                <td class="leftcntnt"><?php
                $cmp_con = $fetch->table_list_arr('m_cmp3','f_id',$pro_det['c_id']);
                foreach($cmp_con as $cont){
                    echo $cont['con_name']."-".$cont['con_num']."<br>";
                }
                $pro_det['purpose']; ?>
                </td>

            </tr>
            <tr>
                <td class="lefthead">Project Value</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['pro_val']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Technology</td>
                <td>:</td>
                <td class="leftcntnt">
                    <?php
                    $tech_end = end($tech);
                    foreach($tech as $th){
                        if($th!=$tech_end){
                            echo $th.", ";
                        }else{
                            echo $th;
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="lefthead">Estimated Start Date</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo date("d-m-Y",strtotime($pro_det['st_date'])); ?></td>
            </tr>
            <tr>
                <td class="lefthead">Required Date</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo date("d-m-Y",strtotime($pro_det['re_date'])); ?></td>
            </tr>
            <tr>
                <td class="lefthead">Payment Terms</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['pay_term']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">Agreement</td>
                <td>:</td>
                <td class="leftcntnt">
                <?php
                    $agree_end = end($agree);
                    foreach($agree as $ag){
                        if($ag!=$agree_end){
                            echo $ag.", ";
                        }else{
                            echo $ag;
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="lefthead">Platform</td>
                <td>:</td>
                <td class="leftcntnt">
                <?php
                    $plat_end = end($plat);
                    foreach($plat as $pl){
                        if($pl!=$plat_end){
                            echo $pl.", ";
                        }else{
                            echo $pl;
                        }
                    }
                    ?>
                 </td>
            </tr>
            <tr>
                <td class="lefthead">Why they need Software</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['need_soft']; ?></td>
            </tr>
            <tr>
                <td class="lefthead">What was the current issue in system</td>
                <td>:</td>
                <td class="leftcntnt"><?php echo $pro_det['current']; ?></td>
            </tr>
        </tbody>
    </table>
</div>