<div class="col-md-10">

  <div class="row">

    <div class="col-md-6 col-md-offset-3">
      <div class="content-box-large">
        <div class="panel-heading">
          <dir class="panel-title" >Arrage Deals as Top Deals</dir>
        </div>
        <div class="panel-body">
         <form class="form-inline ">
           <div class="dropdown" style="float: left; width: 100%" >
             <select class="JquerySearchBox" style="width: 100%;" >
              <option value="one">One</option>
              <option value="two">Two</option>
              <option value="three">Three</option>
              <option value="four">Four</option>
              <option value="five">Five</option>
            </select>
          </div>
          <div class="from-group pull-right" >
            <br/>
            <button type="submit" class="btn btn-default btn-primary">Add</button>  
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-md-12"> 
    <div class="content-box-large">
     <div class="panel-heading">
      <div class="panel-title">Striped Rows</div>
    </div>
    <div class="panel-body">
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
          </tr>
        </thead>
        <tbody>
          <?php foreach(  (array) $deals as  $key => $deal):  ?>
            <tr>
              <td><?php  echo $key+1;?></td>
              <td><?php echo $deal['DealName']; ?></td>
              <td><?php echo $deal['CompanyName']; ?></td>
              <td><?php echo $deal['DealPrice']; ?></td>
              <td><?php echo $deal['DealDiscountPercent']; ?></td>
              <td><?php echo date("Y-m-d h:i:a",  strtotime($deal['DealStart'])); ?></td>
              <td><?php echo date("Y-m-d h:i:a",  strtotime($deal['DealExpire'])); ?></td>
            </tr>
          <?php  endforeach;  ?>
          <tr>
            <td>3</td>
            <td>Larry</td>
            <td>the Bird</td>
            <td>@twitter</td>
            <td>@facebook</td>
            <td>Num</td>
            <td>the Bird</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
</div>