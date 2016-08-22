<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title">Deals</div>
                </div>
                <?php 
                   $success = $this->session->flashdata('success');
                   $error = $this->session->flashdata('success');
                 if(!empty($success)){
                 ?>
                <div class="alert alert-success" role="alert">
                        <?php echo $success;  ?>
                </div>
                 <?php }else if(!empty ($error)){ ?>
                   <div class="alert alert-danger" role="alert">
                       <?php  echo $error; ?>
                  </div>
                 <?php } ?>
                <div class="panel-body" style="overflow-y:auto">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Start Date</th>
                                <th>Expire Date</th>
                                <th>Action</th>
                             </tr>
                        </thead>
                        <tbody>
                        <?php foreach($deals as  $key => $deal):  ?>
                            <tr>
                                <td><?php  echo $key+1;?></td>
                                <td><?php echo $deal['DealName']; ?></td>
                                <td><?php echo $deal['CompanyName']; ?></td>
                                <td><?php echo $deal['DealPrice']; ?></td>
                                <td><?php echo $deal['DealDiscountPercent']; ?></td>
                                <td><?php echo date("Y-m-d h:i:a",  strtotime($deal['DealStart'])); ?></td>
                                <td><?php echo date("Y-m-d h:i:a",  strtotime($deal['DealExpire'])); ?></td>
                                <td><button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button> <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i>Delete</button></td>
                            </tr>
                          <?php  endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>