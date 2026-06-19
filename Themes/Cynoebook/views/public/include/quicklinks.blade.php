@push('styles')
<style type="text/css">
    .section h1 {
    font-size: 37px;
    }

    .section .box-information {
        height: 100px;
        border: 1px solid #dbdbdb;
        /*margin-bottom: 30px;*/
    }

    .section .box-information a {
        font-size: 21px;
        line-height: 29px;
        font-weight: 600;
        padding-left: 20px;
        padding-right: 20px;
        display: flex;
        align-items: center;
        height: 100%;
        position: relative;
        color: #5f7783;
        border-bottom: 2px solid #5f7783;
    }

    .section .box-information a:hover {
        transition: all, 0.4s, ease;
        color: #5f7783;
        text-decoration: none;
        border: 1px solid #5f7783;
    }


    /* Media Queries */

    @media (min-width: 768px) {
        .section h1 {
            margin-bottom: 8px;
        }
    }

    @media (min-width: 992px) {
        .section .box-information {
            margin: 0 5px 30px;
        }
    }

    @media (max-width: 767.98px) {
        .section .box-information {
            height: 85px;
            margin-bottom: 15px;
        }
    }
</style>
@endpush
<section class="section  mt-50 ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-20 mt-30">Quick Links</h2>

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/about-us">How it Works</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/services">Hire a Writer</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/faq">Frequently Asked Questions</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/all-departments">View All Departments</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/app">Final Year Project Topics</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/services/assignment">Assignments</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/Past-Questions-and-Answers">Past Questions and Answers</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
                        <div class="box-information mx-0">
                            <a href="/contact">Get Help/Support</a>
                        </div>
                        <!-- .box-information-->
                    </div>

                    
                </div>
                <!-- .row-->
            </div>
        </div>
    </div>
</section>