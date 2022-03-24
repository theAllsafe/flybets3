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
                            <a href="#activity_purchases" data-toggle="tab" role="tab"
                               aria-selected="false">Purchases</a>
                            <a href="#activity_emails" data-toggle="tab" role="tab" aria-selected="false">Emails</a>
                            <a href="#activity_quotes" data-toggle="tab" role="tab" aria-selected="false">Quotes</a>
                            <a href="#activity_quotes" data-toggle="tab" role="tab" aria-selected="false">Quotes</a>
                            <a href="#activity_quotes" data-toggle="tab" role="tab" aria-selected="false">Quotes</a>
                            <a href="#activity_quotes" data-toggle="tab" role="tab" aria-selected="false">Quotes</a>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane active show fade" id="activity_all">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur ab aliquam labore, rem
                                laboriosam soluta quam minima asperiores suscipit! Sint doloribus laboriosam tempora,
                                modi
                                voluptatem pariatur numquam unde!

                            </div>
                            <div class="tab-pane fade" id="activity_purchases">
                                Quam ducimus culpa eveniet adipisci officiis ab, quas sint aliquid eius tempore natus
                                magnam
                                similique placeat, perferendis explicabo eum qui quod facilis quae enim harum. Nihil
                                dolores
                                enim, dicta modi expedita architecto distinctio!
                            </div>
                            <div class="tab-pane fade" id="activity_emails">
                                Ducimus aperiam aut corporis, facere nobis id quos dignissimos, ut corrupti asperiores
                                reprehenderit culpa praesentium exercitationem, officia commodi.
                            </div>
                            <div class="tab-pane fade" id="activity_quotes">
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
