<div class="col-md-8 col-sm-offset-1">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">Add Deal</div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="<?php echo site_url('admin/deals/save_deal'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="deal_name" class="col-sm-3 control-label">Deal Name: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="deal_name"  id="deal_name" placeholder="Enter deal name" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="DealPrice" class="col-sm-3 control-label">Deal Price:</label>
                    <div class="col-sm-9">
                        <input type="number" min="0"   step="any"  class="form-control" id="DealPrice" name="DealPrice" placeholder="Deal price" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="DealDiscountPercent" class="col-sm-3 control-label">Deal Discount:</label>
                    <div class="col-sm-9">
                        <input type="number" min="0"   step="any"  class="form-control" id="DealDiscountPercent" name="DealDiscountPercent" placeholder="Deal discount" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="DealStart" class="col-sm-3 control-label">Deal Start Date:</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control datetimeClass" id="DealStart" name="DealStart" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="DealExpire" class="col-sm-3 control-label">Deal Expire Date:</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control datetimeClass" id="DealExpire" name="DealExpire" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="DealExpire" class="col-sm-3 control-label">Company Name:</label>
                    <div class="col-sm-9">
                        <select class="form-control JquerySearchBox input-lg" name="CompanyID" required="true">
                            <option value="">Select Company</option>
                             <?php foreach($companies as $company):   ?>
                            <option value="<?php echo $company['CompanyID'];  ?>"><?php echo $company['CompanyName'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Deal Image: </label>
                    <div class="col-sm-9">
                        <input type="file"  class="form-control" name="deal_img"  id="deal_img" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Deal Attachment: </label>
                    <div class="col-sm-9">
                        <input type="file"  class="form-control" name="deal_attach"  id="deal_attach" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Deal Description: </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="DealDescription" id="DealDescription" placeholder="Deal Description" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group pull-right">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save Deal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


