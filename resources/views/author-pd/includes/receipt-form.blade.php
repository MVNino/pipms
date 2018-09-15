
<div class="card">
        <div class="card-header">
            <h5 class="card-title">Applicant Receipt</h5>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body">
                        <small id="contactHelp" class="form-text text-muted">Receipt from your copyright request fee. These fields are <span class="text-info">required.</span></small>
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        {{ Form::label('lblReceiptCode', 'Receipt Code', ['style' => 'font-weight: bold;']) }}
                                    {{ Form::text('txtReceiptCode', '', ['class' => 'form-control', 'placeholder' => 'Enter receipt code']) }}
                                <small id="contactHelp" class="form-text text-muted">Example: ###</small>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            {{ Form::label('lblReceiptCode', 'Receipt', ['class' => 'control-label', 'style' => 'font-weight: bold;']) }}
                                            {{ Form::file('fileReceiptImg', ['class' => 'form-control']) }}
                                    <small id="contactHelp" class="form-text text-muted">Upload a photo of your transaction receipt.</small>	
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>			
        </div>
    </div>