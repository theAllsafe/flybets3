@extends('layouts.index')
@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="
                  page__heading
                  d-flex
                  flex-column flex-md-row
                  align-items-center
                  justify-content-center justify-content-lg-between
                  text-center text-lg-left
                ">
                <h1 class="m-lg-0">Support</h1>
            </div>
        </div>

        <div class="container-fluid page__container">
            <div class="row">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header card-header-large bg-white d-flex align-items-center">
                            <h4 class="card-header__title flex m-0">Frequently Asked Questions (FAQs)</h4>
                        </div>
                        <div class="card-header card-header-tabs-basic nav" role="tablist">
                            <a href="#activity_all" class="active" data-toggle="tab" role="tab"
                               aria-controls="activity_all"
                               aria-selected="true">Managing Your Records</a>
                            <a href="#activity_managing_users" data-toggle="tab" role="tab"
                               aria-selected="false">Managing Users</a>
                            <a href="#activity_using_map" data-toggle="tab" role="tab" aria-selected="false">Using the map</a>
                            <a href="#activity_flight_plans" data-toggle="tab" role="tab" aria-selected="false">Flight Plans</a>
                            <a href="#activity_organisation" data-toggle="tab" role="tab" aria-selected="false">Organisation</a>
                            <a href="#activity_help_support" data-toggle="tab" role="tab" aria-selected="false">Help & Support</a>
                            <a href="#activity_profile_account" data-toggle="tab" role="tab" aria-selected="false">Your Profile & Account</a>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane active show fade" id="activity_all">
                               	<b>How do I add an Unmanned Aircraft?</b><br>
			       	<br>
                                	Click on ‘Unmanned Aircraft’ under ‘My Records’ and select ‘Add an Unmanned Aircraft’. Then complete the form and submit to save. Saved aircraft             
                                	will be available to select in your Flight Plans.
			       	<br>
			       	<br>
			       	<b>How do I update an Unmanned Aircraft?</b><br>
			       	<br>
                                	Click on ‘Unmanned Aircraft’ under ‘My Records’ and select ‘Manage Unmanned Aircraft’. Update the form as required and submit to save.
				Note! Updated details will only be applied to new Flight Plans that are assigned to that aircraft.
			       	<br>
			       	<br>
				<b>How do I remove an Unmanned Aircraft?</b><br>
			       	<br>
                                	Click on ‘Unmanned Aircraft’ under ‘My Records’ and select ‘Manage Unmanned Aircraft’. Find the Unmanned Aircraft in the table that you wish to remove, 
				select “Remove” from option button which will prompt to confirm you wish to remove the aircraft. This will not affect missions that have already been submitted.
				<b>Note! This action cannot be undone.</b>
			       	<br>
			       	<br>
				<b>How do I remove a UAS Pilot from my organisation?</b><br>
			       	<br>
                                	Click ‘UAS Operator’ under ‘My Records’ and select ‘Manage UAS Pilot’. Find the UAS Pilot in the table that you wish to un-link from your organisation, 
				select “Remove” from option button which will prompt to confirm you wish to remove the UAS Pilot. Removing a UAS Pilot will not affect any Flight Plans that have already been 				
				submitted.
				<b>Note! This action cannot be undone, however if you need to re-link the UAS Pilot later, you can simply issue them a new invite link.</b>
			       	<br>
			       	<br>
				<b>I can’t find an Unmanned Aircraft / UAS Pilot / Flight Plans I created?</b><br>
			       	<br>
                                	If you are unable to see the correct details you are looking for, please check you are viewing the correct organisation context in the top-right drop-down menu. 
				If the record isn’t listed there, or under any other organisation to which you have access, then please get in touch with us via the ‘Contact us’ details under the ‘Support’ menu.
                            </div>
                            <div class="tab-pane fade" id="activity_managing_users">
                                Quam ducimus culpa eveniet adipisci officiis ab, quas sint aliquid eius tempore natus
                                magnam
                                similique placeat, perferendis explicabo eum qui quod facilis quae enim harum. Nihil
                                dolores
                                enim, dicta modi expedita architecto distinctio!
                            </div>
                            <div class="tab-pane fade" id="activity_using_map">
                                Ducimus aperiam aut corporis, facere nobis id quos dignissimos, ut corrupti asperiores
                                reprehenderit culpa praesentium exercitationem, officia commodi.
                            </div>
                            <div class="tab-pane fade" id="activity_flight_plans">
                                Odit consectetur dolore maxime similique qui officia deserunt fugiat quo tempore
                                consequuntur
                                dicta ratione sint commodi eum eligendi, magnam aliquid expedita quas accusantium, sed
                                nobis
                                tenetur illum mollitia. Quis ipsum tenetur distinctio tempore vitae atque quam.
                            </div>
                            <div class="tab-pane fade" id="activity_organisation">
                                Odit consectetur dolore maxime similique qui officia deserunt fugiat quo tempore
                                consequuntur
                                dicta ratione sint commodi eum eligendi, magnam aliquid expedita quas accusantium, sed
                                nobis
                                tenetur illum mollitia. Quis ipsum tenetur distinctio tempore vitae atque quam.
                            </div>
                            <div class="tab-pane fade" id="activity_help_support">
                                Odit consectetur dolore maxime similique qui officia deserunt fugiat quo tempore
                                consequuntur
                                dicta ratione sint commodi eum eligendi, magnam aliquid expedita quas accusantium, sed
                                nobis
                                tenetur illum mollitia. Quis ipsum tenetur distinctio tempore vitae atque quam.
                            </div>
                            <div class="tab-pane fade" id="activity_profile_account">
                                Odit consectetur dolore maxime similique qui officia deserunt fugiat quo tempore
                                consequuntur
                                dicta ratione sint commodi eum eligendi, magnam aliquid expedita quas accusantium, sed
                                nobis
                                tenetur illum mollitia. Quis ipsum tenetur distinctio tempore vitae atque quam.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection