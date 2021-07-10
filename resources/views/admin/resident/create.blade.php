@extends('layouts.appsecond', ['menu' => 'addresident'])

@section('content')
	@if(session('flash'))
		<div class="alert alert-primary">
			{{ session('flash') }}
		</div>
	@endif

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
            <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">New Resident</h5>
                    <!--end::Title-->
                    
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-muted">Home &nbsp;</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->

                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter resident details and submit</span>
                    </div>
                    <!--end::Search Form-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <!--begin::Wizard-->
                        <div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="step-first" data-wizard-clickable="true">
                            <!--begin::Wizard Body-->
                            <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                                <div class="col-xl-12">
                                    <ul class="nav nav-tabs nav-tabs-line">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Personal Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">POA(Multiple Representatives)</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Physician/Medical and Dentist</a>
                                        </li>
                                        @if($setting_tabs)
                                            <?php $i = 4; ?>
                                            @foreach($setting_tabs as $st)
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_<?= $i; ?>">{{ $st->name }}</a>
                                                </li>
                                                <?php $i++; ?>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="tab-content mt-5 pt-10 pb-10" id="myTabContent">
                                        <input type="hidden" name="user_id" id="user_id" value="" />
                                        
                                        <div class="tab-pane fade show active justify-content-center" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
                                            <div>
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label text-left">Avatar<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                                            <div class="image-input-wrapper"></div>
                                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Add avatar">
                                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                                <input type="file" name="profile_logo" accept=".png, .jpg, .jpeg" />
                                                                <input type="hidden" name="profile_avatar_remove" />
                                                            </label>
                                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="firstname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="middlename" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="lastname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="la la-at"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="email" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->
                                                
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Date of birthday<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="birthday" type="date" data-format="mm/dd/yyyy" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Gender<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <select class="form-control form-control-solid form-control-lg" name="gender">
                                                            <option value="">Choose...</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->
                                                
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Phone Number<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="phone_number" placeholder="Phone Number" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Street<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="street1" placeholder="Street" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <div class="col-lg-3 col-xl-3"></div>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="street2" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">City<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Zip Code<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="zip_code" placeholder="Zip Code" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">State<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="state" placeholder="State" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Date Admitted</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="date_admitted" type="date" data-format="mm/dd/yyyy" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">SSN</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="ssn" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">PRIMARY LANGUAGE</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="primary_language" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade justify-content-center" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                            <div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Type </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <select class="form-control physician_medical_dentist_type">
                                                            <option value="1">Medical POA</option>
                                                            <option value="2">Financial POA</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name<span style="color: red;">*</span> </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="poa_firstname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name<span style="color: red;">*</span> </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="poa_lastname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Street<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="poa_street1" placeholder="Street" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <div class="col-xl-3 col-lg-3"></div>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="poa_street2" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">City<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="poa_city" placeholder="City" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Zip Code<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="poa_zip_code" placeholder="Zip Code" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">State<span style="color: red;">*</span></label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="poa_state" placeholder="State" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">HOME PHONE </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="poa_home_phone" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">CELL PHONE </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="poa_cell_phone" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade justify-content-center" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                            <div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Type </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <select class="form-control physician_medical_dentist_type">
                                                            <option value="1">Physician or Medical Group</option>
                                                            <option value="2">Pharmacy</option>
                                                            <option value="3">Dentist</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_firstname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_lastname" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Street</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_street1" placeholder="Street" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <div class="col-xl-3 col-lg-3"></div>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_street2" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">City</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_city" placeholder="City" />
                                                        </div>
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">PHONE </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_phone" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                                <!--end::Group-->

                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">FAX </label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg" name="physician_or_medical_group_fax" type="text" />
                                                    </div>

                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($setting_tabs)
                                            <?php $i = 4; ?>
                                            @foreach($setting_tabs as $st)
                                                <div class="tab-pane fade justify-content-center" id="kt_tab_pane_<?= $i; ?>" role="tabpanel" aria-labelledby="kt_tab_pane_<?= $i; ?>">
                                                    <div class="form-group row">
                                                        @foreach($fields as $fl)
                                                            @if($fl->tabId == $st->id && $fl->fieldName)
                                                                <label class="col-form-label pl-5">{{ $fl->fieldName }}</label>
                                                                <select class="form-control col-lg-3 ml-3">
                                                                    <?php 
                                                                        $fieldsTypes = App\FieldTypes::where('fieldID', $fl->id)->get();

                                                                        if($fieldsTypes){
                                                                            foreach ($fieldsTypes as $ft) { ?>
                                                                                <option value="{{ $ft->id }}">{{ $ft->typeName }}</option>
                                                                    <?php } } ?>
                                                                </select>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <?php $i++; ?>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-center pt-5">
                                        <button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" id="submit-resident-info">Submit</button>    
                                    </div>
                                </div>
                            </div>
                            <!--end::Wizard Body-->
                        </div>
                        <!--end::Wizard-->
                    </div>
                    <!--end::Body-->
                </div>                                            
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

    <style type="text/css">
        .help-block {
            color: red;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('finaldesign/assets/js/pages/custom/user/add-user.js') }}"></script>
@endsection