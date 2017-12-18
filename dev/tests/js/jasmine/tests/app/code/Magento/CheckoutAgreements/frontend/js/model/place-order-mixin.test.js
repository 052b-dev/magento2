/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'squire'
], function (Squire) {
    'use strict';

    describe('Magento_CheckoutAgreements/js/model/place-order-mixin', function () {
        var injector = new Squire(),
            mocks = {
                'Magento_Checkout/js/action/place-order': jasmine.createSpy('placeOrderAction'),
                'Magento_CheckoutAgreements/js/model/agreements-assigner': jasmine.createSpy('agreementsAssigner')
            },
            mixin,
            placeOrderAction;

        beforeEach(function (done) {
            window.checkoutConfig = {
                checkoutAgreements: {
                    isEnabled: true
                }
            };
            injector.mock(mocks);
            injector.require([
                'Magento_CheckoutAgreements/js/model/place-order-mixin',
                'Magento_Checkout/js/action/place-order'
            ], function (Mixin, placeOrder) {
                mixin = Mixin;
                placeOrderAction = placeOrder;
                done();
            });
        });

        describe('Magento_Checkout/js/action/place-order', function () {
            it('Magento_CheckoutAgreements/js/model/agreements-assigner is called', function () {
                var messageContainer = jasmine.createSpy('messageContainer'),
                    paymentData = {};
                mixin(placeOrderAction)(paymentData, messageContainer);
                expect(mocks['Magento_CheckoutAgreements/js/model/agreements-assigner'])
                    .toHaveBeenCalledWith(paymentData);
                expect(mocks['Magento_Checkout/js/action/place-order'])
                    .toHaveBeenCalledWith(paymentData, messageContainer);
            });
        });
    });
});
