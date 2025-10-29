@include('header')
<!-- ==================================================== -->
<!-- Start right Content here -->
<!-- ==================================================== -->
<div class="page-content">
   <!-- Start Container Fluid -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header">
                  <div class="d-flex flex-wrap justify-content-between gap-3">
                     @if (empty($load->id))
                     <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Add Pending Load </h4>
                     @else
                     <h4 class="card-title d-flex align-items-center gap-1" id="hidden_column"> Update Pending Load </h4>
                     @endif  
                  <a href="load-creation.php" class="btn btn-primary btn-sm"><i class="bx bx-arrow-back me-1"></i>Back  </a>
               </div>
               </div>
                @php
                  $isEdit = isset($load);
               @endphp
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12">
                        
                        <form action="{{ $isEdit ? route('update_load_query', $load->id) : route('add_load_creation_query') }}" id="loadForm" method="post">
                            @csrf
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Load Number</label>
                                          <input type="text" id="txtLoadNum" disabled="disabled" class="form-control" />
                                       </div>
                                    </div>
                                   <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Bill To</label><span style="color:red;">*</span> 
                                          <a href="{{ route('AddLoadCustomer') }}" target="t_blank">Add New</a>
                                          <select class="form-control shadow-none col-12" name="customer_id" data-choices>
                                              @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" 
                                                      {{ old('customer_id', $load->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                                                      {{ $customer->customer_name }}
                                                </option>
                                             @endforeach
                                        </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3" style="display:none;">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Dispatcher</label><span style="color:red;">*</span>
                                          <select class="form-control" id="dispatcher" name="dispatcher">
                                             <option value="">--select--</option>
                                             <option value="Anu M">Anu M</option>
                                          </select>
                                       </div>
                                    </div>
                                
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Status</label><span style="color:red;">*</span>
                                          <select class="form-control" id="load_status" name="load_status">
                                             <option value="" disabled selected>--Select--</option>
                                             <option value="Open" {{$isEdit && $load->load_status == 'Open' ? 'selected' : '' }}>Open</option>
                                             <option value="Covered" {{$isEdit && $load->load_status == 'Covered' ? 'selected' : '' }}>Covered</option>
                                             <option value="Dispatched" {{$isEdit && $load->load_status == 'Dispatched' ? 'selected' : '' }}>Dispatched</option>
                                             <option value="Loading" {{$isEdit && $load->load_status == 'Loading' ? 'selected' : '' }}>Loading</option>
                                             <option value="On Route" {{$isEdit && $load->load_status == 'On Route' ? 'selected' : '' }}>On Route</option>
                                             <option value="Unloading" {{$isEdit && $load->load_status == 'Unloading' ? 'selected' : '' }}>Unloading</option>
                                             <option value="In Yard" {{$isEdit && $load->load_status == 'In Yard' ? 'selected' : '' }}>In Yard</option>
                                             <option value="Delivered" {{$isEdit && $load->load_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                             <option value="Completed" {{$isEdit && $load->load_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                             <option value="Pending Claims" {{$isEdit && $load->load_status == 'Pending Claims' ? 'selected' : '' }}>Pending Claims</option>
                                             <option value="Claim Closed" {{$isEdit && $load->load_status == 'Claim Closed' ? 'selected' : '' }}>Claim Closed</option>
                                             <option value="To be recovered" {{$isEdit && $load->load_status == 'To be recovered' ? 'selected' : '' }}>To be recovered</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Wo</label>
                                          <input type="text" id="wo" name="wo" class="form-control" value="{{ $isEdit ? $load->wo : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="mb-3">
                                        <label for="payment_type" class="form-label">Payment Type <span class="text-danger">*</span></label>
                                        <select class="form-select" id="payment_type" name="payment_type">
                                          <option selected disabled>-- Select --</option>
                                          <option value="PREPAID" {{$isEdit && $load->payment_type == 'PREPAID' ? 'selected' : '' }}>PREPAID</option>
                                          <option value="POSTPAID" {{$isEdit && $load->payment_type == 'POSTPAID' ? 'selected' : '' }}>POSTPAID</option>
                                        </select>
                                      </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Type</label><span style="color:red;">*</span>
                                          <input type="text" id="type" name="type" class="form-control" value="{{ $isEdit ? $load->type : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Shipper Rate</label><span style="color:red;">*</span>
                                          <input type="text" id="shipper_rate" name="shipper_rate"class="form-control" value="{{ $isEdit ? $load->shipper_rate : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">P/D s</label>
                                          <input type="number" id="pds" name="pds" class="form-control" value="{{ $isEdit ? $load->pds : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">F.S.C</label>
                                          <label for="chkrate">Rate %</label>
                                          <input type="checkbox" id="fsc_per" name="fsc_per" value="Yes" {{ ($isEdit && $load->fsc_per == 'Yes') ? 'checked' : '' }}/>
                                          <input type="number" id="fsc" max="9999999999" name="fsc" class="form-control" value="{{ $isEdit ? $load->fsc : '' }}"/>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Other Charges</label>
                                          <a class="nav-item" id="addcons" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                          <i class="fa fa-plus" aria-hidden="true"></i>
                                          </a>
                                           <input type="text" id="other_charge_id" name = "other_charge_id" readonly  class="form-control" value="{{ $isEdit ? $load->other_charge_id : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Final Shipper Rate</label>
                                          <input type="text" id="finSipRate" name="final_shipper_rate" class="form-control number" disabled value="{{ $isEdit ? $load->final_shipper_rate : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Advance Payment</label>
                                         <input type="number" id="adv_payment" name="adv_payment" class="form-control" value="{{ $load->adv_payment ?? '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Load Type</label><span style="color:red;">*</span>
                                          <select class="form-control" id="load_type" name="load_type">
                                             <option value="" disbled>--select--</option>
                                             <option value="OTR" {{$isEdit && $load->load_type == 'OTR' ? 'selected' : '' }}>OTR</option>
                                             <option value="Dray-age" {{$isEdit && $load->load_type == 'Dray-age' ? 'selected' : '' }}>Dray-age</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Billing Type</label>
                                          <select class="form-control" id="bill_type" name="bill_type">
                                             <option value="" disabled>--select--</option>
                                             <option value="Factoring" {{$isEdit && $load->bill_type == 'Factoring' ? 'selected' : '' }}>Factoring</option>
                                             <option value="Direct Billing" {{$isEdit && $load->bill_type == 'Direct Billing' ? 'selected' : '' }}>Direct Billing</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">MC No</label><span style="color:red;">*</span>
                                          <input type="text" id="mc_no" name="mc_no"  class="form-control" value="{{ $isEdit ? $load->mc_no : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Carrier</label>
                                          <input type="text" id="carrier" name="carrier"  class="form-control" readonly="readonly" disabled />
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Equipment Type</label><span style="color:red;">*</span>
                                          <select class="form-control" id="equipment_type" name="equipment_type">
                                             <option value="" disabled>--select--</option>
                                             <option value="Air Freight" {{$isEdit && $load->equipment_type == 'Air Freight' ? 'selected' : '' }}>Air Freight</option>
                                             <option value="Auto Carrier" {{$isEdit && $load->equipment_type == 'Auto Carrier' ? 'selected' : '' }}>Auto Carrier</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Carrier Fee</label><span style="color:red;">*</span>
                                          <input type="text" id="carrier_fee" name="carrier_fee"  class="form-control number" value="{{ $isEdit ? $load->carrier_fee : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Currency</label>
                                          <select class="form-control" id="currency" name="currency">
                                             <option value="">--select--</option>
                                             <option value="INR" {{$isEdit && $load->currency == 'INR' ? 'selected' : '' }}>INR</option>
                                             <option value="Dollar" {{$isEdit && $load->currency == 'Dollar' ? 'selected' : '' }}>Dollar</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">P/D s</label>
                                          <input type="number" id="txtCarrierPDS" class="form-control" name="carrier_pds" value="{{ $isEdit ? $load->carrier_pds : '' }}"/>
                                       </div>
                                    </div>
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">F.S.C</label>
                                          <label for="chkCarrierrate">Rate %</label>
                                         <input type="checkbox" id="chkCarrierrate" name="carrierrate_check" {{ ($isEdit && $load->carrierrate_check == 'on') ? 'checked' : '' }}>
                                          <input type="number" id="txtCarrierfscrate" min="0" max="100" class="form-control" name="carrierrate" value="{{ $isEdit ? $load->carrierrate : '' }}"/>
                                       </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Other Charges</label>
                                          <a class="nav-item" id="addCarriercons" data-bs-toggle="modal" data-bs-target="#CarrierModalLong">
                                          <i class="fa fa-plus" aria-hidden="true"></i>
                                          </a>
                                       </div>
                                    </div> --}}
                                    <div class="col-md-3">
                                       <div class="form-group mb-3">
                                          <label class="control-label mb-1">Final Carrier Fee</label>
                                          <input type="text" id="txtCarrierRateNw" class="form-control number" name="final_carrier_fee" disabled="disabled" />
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                            <nav>
                                  <div class="nav nav-tabs" id="shipper-tab" role="tablist">
                                    <!-- Default Shipper -->
                                    <a class="nav-item nav-link active" id="ship1" data-bs-toggle="tab" href="#tab01" role="tab">Shipper 1</a>

                                    <!-- Hidden Shippers -->
                                    <a class="nav-item nav-link" id="ship2" style="display:none;" data-bs-toggle="tab" href="#tab02" role="tab">
                                      Shipper 2 <i class="fa fa-times text-danger ms-1" onclick="hideShipper('tab02','ship2');"></i>
                                    </a>
                                    <a class="nav-item nav-link" id="ship3" style="display:none;" data-bs-toggle="tab" href="#tab03" role="tab">
                                      Shipper 3 <i class="fa fa-times text-danger ms-1" onclick="hideShipper('tab03','ship3');"></i>
                                    </a>
                                    <a class="nav-item nav-link" id="ship4" style="display:none;" data-bs-toggle="tab" href="#tab04" role="tab">
                                      Shipper 4 <i class="fa fa-times text-danger ms-1" onclick="hideShipper('tab04','ship4');"></i>
                                    </a>

                                    <!-- Add Button -->
                                    <a class="nav-item nav-link" id="addshipper" onclick="AddNewShipper();">
                                      <i class="fa fa-plus"></i>
                                    </a>
                                  </div>
                                </nav>
                                 <div class="tab-content carrier_tabs pt-4" id="nav-tabContent" name="shipper_details">
                                       @for ($i = 0; $i < 4; $i++)
                                          <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}" id="tab0{{ $i + 1 }}">
                                                <div class="row">
                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Shipper</label><span style="color:red;">*</span>
                                                            <a href="{{ route('add_shipper')}}" target="popup">Add New</a>
                                                            <select class="form-control shadow-none col-12" name="shipper_details[{{ $i }}][shipper_id]" data-choices>
                                                               <option value="">Please Select</option>
                                                               @foreach ($shippers as $shipper)
                                                                  <option value="{{ $shipper->id }}">{{ $shipper->name }}</option>
                                                               @endforeach
                                                            </select>
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Location</label>
                                                            <input type="text" class="form-control loc" id="shipper_details[{{ $i }}][shipper_location]" name="shipper_details[{{ $i }}][shipper_location]" readonly/>
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Date</label><span style="color:red;">*</span>
                                                            <input type="date" class="form-control datepicker" name="shipper_details[{{ $i }}][shipper_date]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Show Time <input type="checkbox" id="chktime" /> </label>
                                                            <select class="form-control drpShipperTime" name="shipper_details[{{ $i }}][shipper_chktime]"></select>
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Description</label>
                                                            <input type="text" class="form-control" name="shipper_details[{{ $i }}][shipper_description]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Type (TL,LTL,Pallets,etc)</label>
                                                            <input type="text" class="form-control" name="shipper_details[{{ $i }}][shipper_type]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Qty</label>
                                                            <input type="text" class="form-control number" name="shipper_details[{{ $i }}][shipper_qty]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Weight(lbs)</label>
                                                            <input type="text" class="form-control number" name="shipper_details[{{ $i }}][shipper_weight]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Value($)</label><span style="color:red;">*</span>
                                                            <input type="text" class="form-control number" name="shipper_details[{{ $i }}][shipper_value]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Shipping Notes</label>
                                                            <input type="text" class="form-control" name="shipper_details[{{ $i }}][shipping_notes]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">P.O Numbers</label>
                                                            <input type="text" class="form-control" name="shipper_details[{{ $i }}][po_number]" />
                                                      </div>
                                                   </div>

                                                   <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                            <label class="control-label mb-1">Custom Brokers</label>
                                                            <select class="form-control drpCustomBroker" name="shipper_details[{{ $i }}][customer_broker]">
                                                               <option value="">Choose Option</option>
                                                               <option value="A1">A1</option>
                                                               <option value="A2">A2</option>
                                                                
                                                            </select>
                                                      </div>
                                                   </div>
                                                </div>
                                          </div>
                                       @endfor
                                    </div>
                              <div class="col-md-12">
                                 <nav>
                                    <div class="nav nav-tabs" id="consignee-tab" role="tablist">
                                          @for ($i = 0; $i < 4; $i++)
                                             <a class="nav-item nav-link {{ $i == 0 ? 'active' : '' }}" id="con{{ $i+1 }}" style="{{ $i > 0 ? 'display:none;' : '' }}"
                                                data-bs-toggle="tab" href="#tabConsignee0{{ $i+1 }}" role="tab">
                                                Consignee {{ $i+1 }}
                                                @if($i > 0)
                                                   <i class="fa fa-times text-danger ms-1" onclick="hideitems('tabConsignee0{{ $i+1 }}', 'con{{ $i+1 }}');"></i>
                                                @endif
                                             </a>
                                          @endfor
                                          <!-- Add Button -->
                                          <a class="nav-item nav-link" id="addcons" onclick="AddNewConsignee();">
                                             <i class="fa fa-plus"></i>
                                          </a>
                                    </div>
                                 </nav>

                                 <div class="tab-content carrier_tabs pt-4" id="nav-tabContent" name="consignee_details">
                                    @for ($i = 0; $i < 4; $i++)
                                          <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}" id="tabConsignee0{{ $i+1 }}">
                                             <div class="row">
                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Consignee</label><span style="color:red;">*</span>
                                                         <a href="{{ route('add_consignee') }}" target="popup">Add New</a>
                                                         <select class="form-control shadow-none col-12" name="consignee_details[{{ $i }}][consignee_id]" data-choices>
                                                            <option value="">Please Select</option>
                                                            @foreach ($consignees as $consignee)
                                                                  <option value="{{ $consignee->id }}">{{ $consignee->name }}</option>
                                                            @endforeach
                                                         </select>
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Location</label>
                                                         <input type="text" class="form-control conloc" id="consignee_details[{{ $i }}][consignee_location]" name="consignee_details[{{ $i }}][consignee_location]" readonly/>
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Date</label><span style="color:red;">*</span>
                                                         <input type="date" class="form-control datepicker greaterThan" name="consignee_details[{{ $i }}][consignee_date]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Show Time <input type="checkbox" id="chktimeConsignee{{ $i }}" /> </label>
                                                         <select class="form-control drpConsigneeTime" name="consignee_details[{{ $i }}][consignee_time]"></select>
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Description</label>
                                                         <input type="text" class="form-control" name="consignee_details[{{ $i }}][consignee_description]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Type (TL,LTL,Pallets,etc)</label>
                                                         <input type="text" class="form-control" name="consignee_details[{{ $i }}][consignee_type]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Qty</label>
                                                         <input type="text" class="form-control number" name="consignee_details[{{ $i }}][consignee_quantity]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Weight(lbs)</label>
                                                         <input type="text" class="form-control number" name="consignee_details[{{ $i }}][consignee_weight]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Value($)</label><span style="color:red;">*</span>
                                                         <input type="text" class="form-control number" name="consignee_details[{{ $i }}][consignee_value]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Delivery Notes</label>
                                                         <input type="text" class="form-control" name="consignee_details[{{ $i }}][delivery_notes]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">P.O Numbers</label>
                                                         <input type="text" class="form-control" name="consignee_details[{{ $i }}][consignee_po_number]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Pro Miles</label>
                                                         <input type="text" class="form-control number" name="consignee_details[{{ $i }}][consignee_pro_miles]" />
                                                      </div>
                                                </div>

                                                <div class="col-md-3">
                                                      <div class="form-group mb-3">
                                                         <label class="control-label mb-1">Empty</label>
                                                         <input type="text" class="form-control number" name="consignee_details[{{ $i }}][consignee_empty]" />
                                                      </div>
                                                </div>
                                             </div>
                                          </div>
                                    @endfor
                                 </div>
                              </div>


                                 <div class="form_bbtns text-end" id="divcancelbtn" style="display:none;">
                                    <a href="index.php" class="btn btn-success  text-white commonBtn rounded submit px-3">Cancel</a>
                                 </div>
                                 <div class="form_bbtns text-end" id="divallbtn">
                                     @if (empty($load->id))
                                      <button id="btnSubmit" type="submit" class="btn btn-success commonBtn" >Submit</button>
                                       @else
                                       <button id="btnSubmit" type="submit" class="btn btn-success commonBtn" >Update</button>
                                       @endif  
                                    
                                    <a href="index.php" class="btn btn-primary  text-white commonBtn rounded submit px-3">Cancel</a>
                                 </div>
                              </div>
{{-- onclick="saveData(1);" --}}
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                 <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       <!-- Header -->
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Other Charges</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <!-- Body -->
                                       <div class="modal-body" style="height:500px; overflow-y:auto;">
                                          <div class="col-md-12" id="divOtherCharges">
                                             <!-- Tabs -->
                                             <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <li class="nav-item">
                                                   <a class="nav-link active" id="tabOther-tab" data-bs-toggle="tab" href="#tabOtherCharges" role="tab">Charges</a>
                                                </li>
                                                <li class="nav-item">
                                                   <a class="nav-link" id="tabAdv-tab" data-bs-toggle="tab" href="#tabAdvancedCharges" role="tab">Advance Charges</a>
                                                </li>
                                             </ul>
                                             <!-- Tab Content -->
                                             <div class="tab-content carrier_tabs pt-2" id="nav-tabContent">
                                                <!-- Other Charges Tab -->
                                                <div class="tab-pane fade show active" id="tabOtherCharges" role="tabpanel">
                                                   <div class="row">
                                                      <table class="table table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th width="300">Charges</th>
                                                               <th width="100">Amount</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <!-- Repeat rows -->
                                                            <tr>
                                                               <td><input type="text" class="form-control" /></td>
                                                               <td><input type="text" class="form-control number otamt" /></td>
                                                            </tr>
                                                            <tr>
                                                               <td><input type="text" class="form-control" /></td>
                                                               <td><input type="text" class="form-control number otamt" /></td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                                <!-- Advanced Charges Tab -->
                                                <div class="tab-pane fade" id="tabAdvancedCharges" role="tabpanel">
                                                   <div class="row">
                                                      <table class="table table-bordered">
                                                         <thead>
                                                            <tr>
                                                               <th width="300">Charges</th>
                                                               <th width="150">Date</th>
                                                               <th width="100">Amount</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <tr>
                                                               <td><input type="text" class="form-control" /></td>
                                                               <td><input type="text" class="form-control datepicker" autocomplete="off" /></td>
                                                               <td><input type="text" class="form-control number otamt" /></td>
                                                            </tr>
                                                            <tr>
                                                               <td><input type="text" class="form-control" /></td>
                                                               <td><input type="text" class="form-control datepicker" autocomplete="off" /></td>
                                                               <td><input type="text" class="form-control number otamt" /></td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Footer -->
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" onclick="addOtherCharges();">OK</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Modal -->
                              <div class="modal fade" id="CarrierModalLong" tabindex="-1" aria-labelledby="CarrierModalTitle" aria-hidden="true">
                                 <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                       <!-- Modal Header -->
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="CarrierModalTitle">Other Charges</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <!-- Modal Body -->
                                       <div class="modal-body" style="height:500px; overflow-y:auto;">
                                          <div class="col-md-12" id="divCarrierOtherCharges">
                                             <!-- Tabs -->
                                             <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <li class="nav-item">
                                                   <a class="nav-link active" data-bs-toggle="tab" href="#tabCarrierOtherCharges" role="tab">Charges</a>
                                                </li>
                                                <li class="nav-item">
                                                   <a class="nav-link" data-bs-toggle="tab" href="#tabCarrierAdvancedCharges" role="tab">Advance Charges</a>
                                                </li>
                                             </ul>
                                             <!-- Tab Content -->
                                             <div class="tab-content carrier_tabs pt-2" id="nav-tabContent">
                                                <!-- Charges Tab -->
                                                <div class="tab-pane fade show active" id="tabCarrierOtherCharges" role="tabpanel">
                                                   <div class="row">
                                                      <table class="table table-bordered" id="tbCharges">
                                                         <thead>
                                                            <tr>
                                                               <th width="300">Charges</th>
                                                               <th width="100">Amount</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <tr>
                                                               <td><input type="text" id="txtCarrierOtherCharges1" class="form-control" /></td>
                                                               <td><input type="text" id="txtCarrierOtherChargesAmount1" class="form-control number otamt" /></td>
                                                            </tr>
                                                            <tr>
                                                               <td><input type="text" id="txtCarrierOtherCharges2" class="form-control" /></td>
                                                               <td><input type="text" id="txtCarrierOtherChargesAmount2" class="form-control number otamt" /></td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                                <!-- Advanced Charges Tab -->
                                                <div class="tab-pane fade" id="tabCarrierAdvancedCharges" role="tabpanel">
                                                   <div class="row">
                                                      <table class="table table-bordered" id="tbAdvCharges">
                                                         <thead>
                                                            <tr>
                                                               <th width="200">Type</th>
                                                               <th width="300">Notes</th>
                                                               <th width="150">Date</th>
                                                               <th width="100">Amount</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <tr>
                                                               <td><input type="text" id="txtCarrierOtherAdvChargesType1" class="form-control" /></td>
                                                               <td><input type="text" id="txtCarrierOtherAdvCharges1" class="form-control" /></td>
                                                               <td><input type="text" id="txtCarrierOtherAdvChargesDate1" class="form-control datepicker" autocomplete="off" /></td>
                                                               <td><input type="text" id="txtCarrierOtherAdvChargesAmount1" class="form-control number otamt" /></td>
                                                            </tr>
                                                            <tr>
                                                               <td><input type="text" id="txtCarrierOtherAdvChargesType2" class="form-control" /></td>
                                                               <td><input type="text" id="txtCarrierOtherAdvCharges2" class="form-control" /></td>
                                                               <td><input type="text" id="txtCarrierOtherAdvChargesDate2" class="form-control datepicker" autocomplete="off" /></td>
                                                               <td><input type="text" id="txtCarrierOtherAdvChargesAmount2" class="form-control number otamt" /></td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Modal Footer -->
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" onclick="addCarrierOtherCharges();">OK</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end row -->
</div>
<!-- End Container Fluid -->

<script>
let currentShipper = 1;

function AddNewShipper() {
  if (currentShipper >= 4) return; 

  currentShipper++;
  let newTabId = "ship" + currentShipper;
  let newContentId = "tab0" + currentShipper;

  document.getElementById(newTabId).style.display = "inline-block";


  let triggerEl = document.querySelector('#' + newTabId);
  let tab = new bootstrap.Tab(triggerEl);
  tab.show();
}

function hideShipper(contentId, tabId) {
  if (tabId === "ship1") {
    alert("Shipper 1 ");
    return;
  }

  document.getElementById(tabId).style.display = "none";
  document.getElementById(contentId).classList.remove("show", "active");

  let triggerEl = document.querySelector('#ship1');
  let tab = new bootstrap.Tab(triggerEl);
  tab.show();
}
</script>


<script>
let currentConsignee = 1;

function AddNewConsignee() {
  if (currentConsignee >= 15) return; 

  currentConsignee++;
  let newTabId = "con" + currentConsignee;
  let newContentId = "tabConsignee" + (currentConsignee < 10 ? "0" + currentConsignee : currentConsignee);

  document.getElementById(newTabId).style.display = "inline-block";

  let triggerEl = document.querySelector('#' + newTabId);
  let tab = new bootstrap.Tab(triggerEl);
  tab.show();
}

function hideitems(contentId, tabId) {
  if (tabId === "con1") {
    alert("Consignee 1");
    return;
  }

  document.getElementById(tabId).style.display = "none";
  document.getElementById(contentId).classList.remove("show", "active");

  let triggerEl = document.querySelector('#con1');
  let tab = new bootstrap.Tab(triggerEl);
  tab.show();
}
</script>
@include('footer')

   <script>
  const pdsInput = document.getElementById('pds');
  const rateInput = document.getElementById('finSipRate');

  pdsInput.addEventListener('input', function() {
    rateInput.value = pdsInput.value;
  });

   $('#pds').on('input', function() {
    $('#finSipRate').val($(this).val());
  });

</script>

<script>
function addOtherCharges() {
    let chargesData = [];

    $("#tabOtherCharges tbody tr").each(function () {
        let charge = $(this).find("input:eq(0)").val();
        let amount = $(this).find("input:eq(1)").val();

        if (charge !== "" || amount !== "") {
            chargesData.push({
                type: "other",
                charge: charge,
                amount: amount
            });
        }
    });

    $("#tabAdvancedCharges tbody tr").each(function () {
        let charge = $(this).find("input:eq(0)").val();
        let date = $(this).find("input:eq(1)").val();
        let amount = $(this).find("input:eq(2)").val();

        if (charge !== "" || date !== "" || amount !== "") {
            chargesData.push({
                type: "advance",
                charge: charge,
                date: date,
                amount: amount
            });
        }
    });

    $("#other_charge_id").val(JSON.stringify(chargesData));

    $("#exampleModalLong").modal('hide');
}
</script>



<script>
function populateTimeDropdown(dropdown) {
    $(dropdown).empty(); 
    $(dropdown).append('<option value="">Select Time</option>');
    for (let h = 0; h < 24; h++) {
        for (let m = 0; m < 60; m += 30) { 
            let hour = h < 10 ? '0' + h : h;
            let minute = m < 10 ? '0' + m : m;
            let time = hour + ':' + minute;
            $(dropdown).append('<option value="' + time + '">' + time + '</option>');
        }
    }
}

$(document).ready(function() {

    $('#chktime').change(function() {
        if ($(this).is(':checked')) {
            populateTimeDropdown('.drpShipperTime');
        } else {
            $('.drpShipperTime').empty();
        }
    });

    $('[id^=chktimeConsignee]').each(function() {
        let checkbox = $(this);
        let index = this.id.replace('chktimeConsignee', '');
        checkbox.change(function() {
            let dropdown = $('select[name="consignee_details[' + index + '][consignee_time]"]');
            if ($(this).is(':checked')) {
                populateTimeDropdown(dropdown);
            } else {
                dropdown.empty();
            }
        });
    });
});
</script>
<script>
$(document).on('change', 'select[name^="shipper_details"]', function () {
    let shipperId = $(this).val();
    let locationInput = $(this).closest('.col-md-3').parent().find('.loc'); 
    
    if (shipperId) {
        $.ajax({
            url: "{{ route('get_shipper_location', ['id' => ':id']) }}".replace(':id', shipperId),
            type: "GET",
            success: function (res) {
               if (res.location) {
                     locationInput.val(res.location);
               } else {
                     locationInput.val('');
               }
            },
            error: function () {
               locationInput.val('');
            }
         });
    } else {
        locationInput.val('');
    }
});
</script>

<script>
$(document).on('change', 'select[name^="consignee_details"]', function () {
    let consigneeId = $(this).val();
    let locationInput = $(this).closest('.col-md-3').parent().find('.conloc'); 
    
    if (consigneeId) {
        $.ajax({
            url: "{{ route('get_consignee_location', ['id' => ':id']) }}".replace(':id', consigneeId),
            type: "GET",
            success: function (res) {
               if (res.location) {
                     locationInput.val(res.location);
               } else {
                     locationInput.val('');
               }
            },
            error: function () {
               locationInput.val('');
            }
         });
    } else {
        locationInput.val('');
    }
});
</script>