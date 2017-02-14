
    <div class="invest_inner">        

        <div id="tabvanilla" class="widget">            
            <ul class="tabnav">
                <li><a href="#tab1">Diabetes</a></li>
                <li><a href="#tab2">Thyroid</a></li>
                <li><a href="#tab3">Hypertension</a></li>
                <li><a href="#tab4">PCOS/Hirsutism</a></li>
                <li><a href="#tab5">Short Stature</a></li>
                <li><a href="#tab6">Hypogonadism</a></li>
                <li><a href="#tab7">Infertility</a></li>
                <li><a href="#tab8">Precocity</a></li>
                <li><a href="#tab9">Achenol</a></li>
                <li><a href="#tab10">Bone</a></li>
                <li><a href="#tab11">Lung GI</a></li>
                <li><a href="#tab12">Sexual</a></li>
                <li><a href="#tab13">Others</a></li>
            </ul>

            <!--BEGIN tab1-->
            <div  id="tab1" class="tabdiv">
                <div id="tab111" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE1' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest1" type="text" value=""/>
                    <input type="button" class="delete_row" name="ADD" onclick="return addInvestigation('TYPE1')" value="" />

                </div>              
            </div>
            <!--END of tab1-->

            <!--BEGIN tab2-->
            <div id="tab2" class="tabdiv">
                <div id="tab112" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE2' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest2" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE2')" value="" />
                </div>    
            </div>
            <!--END of tab2-->

            <!--BEGIN tab3-->
            <div id="tab3" class="tabdiv">
                <div id="tab113" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE3' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest3" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE3')" value="" />

                </div>  
            </div>
            <!--END of tab3-->

            <!--BEGIN tab4-->
            <div id="tab4" class="tabdiv">
                    <div id="tab114" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE4' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest4" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE4')" value="" />

                </div>
            </div>
            <!--END of tab4-->

            <!--BEGIN tab5-->
            <div id="tab5" class="tabdiv">
                <div id="tab115" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE5' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest5" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE5')" value="" />

                </div>
            </div>
            <!--END of tab5-->

            <!--BEGIN tab6-->
            <div id="tab6" class="tabdiv">
                <div id="tab116" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE6' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest6" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE6')" value="" />

                </div>
            </div>
            <!--END of tab6-->

            <!--BEGIN tab7-->
            <div id="tab7" class="tabdiv">
                <div id="tab117" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE7' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest7" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE7')" value="" />

                </div>
            </div>
            <!--END of tab7-->

            <!--BEGIN tab8-->
            <div id="tab8" class="tabdiv">
                <div id="tab118" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE8' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest8" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE8')" value="" />

                </div>
            </div>
            <!--END of tab8-->

            <!--BEGIN tab9-->
            <div id="tab9" class="tabdiv">
                <div id="tab119" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE9' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest9" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE9')" value="" />

                </div>
            </div>
            <!--END of tab9-->

            <!--BEGIN tab10-->
            <div id="tab10" class="tabdiv">
                <div id="tab1110" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE10' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest10" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE10')" value="" />

                </div>
            </div>
            <!--END of tab10-->

            <!--BEGIN tab11-->
            <div id="tab11" class="tabdiv">
                <div id="tab1111" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE11' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest11" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE11')" value="" />

                </div>
            </div>
            <!--END of tab11-->

            <!--BEGIN tab12-->
            <div id="tab12" class="tabdiv">
                <div id="tab1112" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE12' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest12" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE12')" value="" />

                </div>
            </div>
            <!--END of tab12-->

            <!--BEGIN tab13-->
            <div id="tab13" class="tabdiv">
                <div id="tab1113" class="check_fields" >
                    <?php
                    $query = "select * from investigation_master where investigation_type = 'TYPE13' and STATUS = 'ACTIVE'";
                    $result = mysqli_query($con,$query);
                        while($rs = mysqli_fetch_array($result)) {
                                $cname = $rs['investigation_name'];
                                $inv_id =$rs['ID'];
                                echo "<input name='inv[]' type='checkbox' value='".$inv_id."' />&nbsp;".$cname."&nbsp;";
                        }
                    ?>
                </div>      

                <div  class="addfileds">
                    <input id="invest13" type="text" value=""/>
                    <input type="button" class="delete_row" name="" onclick="return addInvestigation('TYPE13')" value="" />

                </div>
            </div>
            <!--END of tab13-->

        </div>   
    </div>


