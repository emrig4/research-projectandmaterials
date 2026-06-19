@push('styles')
    <style type="text/css">
        .footer-top{
            background: none;
            border: 5px solid whitesmoke;
        }
    </style>
@endpush

@if (setting('newsletter_enabled') && (setting('newsletter_display')=='both' || setting('newsletter_display')=='footer' ))
    <!-- <newsletter-subscription inline-template>
        <section class="subscribe-wrap d-flex justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <div class="subscribe">
                            <div class="row align-items-center">
                                <div class="col-sm-12 col-md-6">
                                    <div class="subscribe-text">
                                        <span class="title">
                                            {{ trans('cynoebook::layout.subscribe_to_our_newsletter') }}
                                        </span>

                                        <span class="sub-title">
                                            {{ trans('cynoebook::layout.subscribe_to_our_newsletter_subtitle') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="subscribe-field">
                                        <form @submit.prevent="subscribe">
                                            <div class="form-group">
                                                <input
                                                    type="text"
                                                    v-model="email"
                                                    class="form-control"
                                                    placeholder="{{ trans('cynoebook::layout.enter_your_email_address') }}"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-subscribe"
                                                    v-if="subscribed"
                                                    v-cloak
                                                >
                                                    <i class="fa fa-check"></i>
                                                    {{ trans('cynoebook::layout.subscribed') }}
                                                </button>

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-subscribe"
                                                    :class="{ 'btn-loading': subscribing }"
                                                    v-else
                                                    v-cloak
                                                >
                                                    {{ trans('cynoebook::layout.subscribe') }}
                                                </button>
                                            </div>
                                            <span class="error-message" v-if="error" v-text="error"></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </newsletter-subscription> -->

    <div class="footer-top" style="background: none; border: 5px solid whitesmoke; color: black">
        <div class="clear-fix"></div>
        <div class="container">
            <div class="footer-top-wrapper">
                <div class="footer-top-left" style="width: 50%">
                    <p class="footer-top-focus">{{ trans('cynoebook::layout.subscribe_to_our_newsletter') }}</p>

                    <p class="footer-top-text">{{ trans('cynoebook::layout.subscribe_to_our_newsletter_subtitle') }}</p>
                </div>
                <div class="footer-top-right">
                   <form action="{{ route('subscribers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-10">
                                <input
                                type="text"
                                id="email"
                                name="email"
                                class="form-control form-email-widget"
                                placeholder="{{ trans('cynoebook::layout.enter_your_email_address') }}"
                            >
                            </div>

                            <div class="col-md-2">
                                <button
                                type="submit"
                                class="btn btn-green"
                            >
                                <span>{{ trans('cynoebook::layout.subscribe') }}</span>
                            </button>
                            </div>
                        </div>
                        <span class="error-message" v-if="error" v-text="error"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endif
