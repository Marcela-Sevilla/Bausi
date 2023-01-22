=== Whols - WooCommerce Wholesale Prices  ===
Contributors: hasthemes, htplugins, devitemsllc, tarekht
Tags: wholesale plugin, wholesale pricing, wholesale prices, woocommerce wholesale, woocommerce b2b
Requires at least: 4.0
Tested up to: 6.0
Requires PHP: 5.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin provides all the necessary features that you will ever need to sell wholesale products from your WooCommerce online store.

== Description ==
Whols is an outstanding WordPress plugin for WooCommerce that allows store owners to set wholesale prices for the products of their online stores. This plugin enables you to show special wholesale prices to the wholesaler. Users can easily request to become a wholesale customer by filling out a simple online registration form. Once the registration is complete, the owner of the store will be able to review the request and approve the request either manually or automatically.

Whols plugin reduces the hassle to create multiple stores for both the consumers and the wholesalers. By utilizing the functionality of this amazing plugin, you can easily maintain both the consumers and the wholesalers from a single store.

[Live Demo](https://theplugindemo.com/whols/demo/create-sandbox/) | [Documentation](https://theplugindemo.com/whols/doc/free/) | [Purchase Pro](https://hasthemes.com/plugins/whols-woocommerce-wholesale-prices/)

== Main Features: ==
* Wholesaler registration form shortcode
* Ability to add custom / additional field into the registration form using filter hook (new)
* Customer can request to become a wholesale customer
* Admin can manage the wholesaler request manually OR Auto approve can be set
* Asign wholesale role for existing customers
* Apply wholesale prices globally
* Add flat/percent amount price on wholesale products
* Easily set wholesale prices on Simple or Variable products
* Add wholesale prices to each variation of a variable products
* Option to enable minimum product to buy
* Shows wholesale pricing info on shop page as well as product detail page
* Show/Hide the retailer price from wholesale customers
* Customers having wholesale role assigned can buy products at wholesale price
* Customize the text on the frontend labels (Retailer Price Text, Wholesaler Price Text & Save Amount Text Label)
* Display the amount that the customer will save after purchase
* Allow free shipping for wholesalers
* Disable coupon codes for wholesale customers so only retailers can use them
* Hide wholesale prices for guest user
* Hide "Wholesale Only" Products From Other Customers
* Hide General Products From Wholesalers
* Wholesale prices are only visible to customers with “Wholesaler” role
* Registration successful message customization
* Redirect to specific page after completed registration
* Redirect to specific page when customer login as a wholesaler
* Hide price for guest users (Login to see price)
* Email Notification (Registration)
* Design Customizations
* Exclude Tax for Wholesale users
* Easy to use backend interface
* No coding required

== Premium Features: ==
✓ Create & manage unlimited user role
✓ Wholesaler request management (Approve / Reject)
✓ Give different pricing to different wholesaler role
✓ Payment methods (gateway) control
✓ Different prices for different users
✓ Category wise product price set
✓ Category wise product price set for different roles
✓ Restrict wholesale store access
✓ Set default wholesaler role for wholesale registration
✓ Enable website access restriction (Entire Website / Only Shop)
✓ Whole can access the Entire Website / Shop (Loged In Users/Loged In Users With Wholesale Role)
✓ Role wise disable payment method
✓ Role wise enable free shipping
✓ Email Notification (Registration, Wholesaler Approve & Rejection)

== <a href="https://hasthemes.com/plugins/whols-woocommerce-wholesale-prices/">Purchase Whols Pro</a>==

== Video Overview: ==
[youtube https://www.youtube.com/watch?v=OArnKMljqWs]

== Video Tutorial: ==
#### How to install Whols plugin and complete the basic setup
[youtube https://youtu.be/4tUrWsNz3TE]

#### How to add a wholesaler registration form & approve role for wholesaler
[youtube https://youtu.be/8eI5k3xgok4]

#### How to set wholesale prices for different categories
[youtube https://youtu.be/inzemTs1SCY]

#### How to hide wholesale prices for guest users
[youtube https://youtu.be/aywuQpKFdF4]

#### How to Enable Free Shipping For Wholesale Customers
[youtube https://youtu.be/e4P9nCNGDJQ]

#### How To Set Different Price For Different Wholesale Customers
[youtube https://youtu.be/cDw4GGuHYyw]

== Need Help? ==
Is there any feature that you want to get in this plugin? 
Needs assistance to use this plugin? 
Feel free to [Contact us](https://hasthemes.com/contact-us/)

== Changelog ==
= Version: 1.1.7 --Date: 9 May 2022 =
* Added: Filter hook whols_label_upto
* Added: Filter hook whols_disable_del_tag
* Fixed: Discount range show 0% for Multiple role

= Version: 1.1.6 --Date: 9 Apr 2022 =
* Fixed: Variable product price decimal issue
* Fixed: When min & max both price is same for variable product, don't show the price range

= Version: 1.1.5 --Date: 12 Mar 2022 =
* Added: Checkbox field support for registration form
* Added: Filter hook to manage capabilities

= Version: 1.1.4 --Date: 13 Feb 2022 =
* Improved: Registration form input fields
* Fixed: Warning on product metabox
* Fixed: Showing price decimal properly
* Added: Wholesale label on cart page
* Fixed: Pricing issue

= Version: 1.1.3 --Date: 12 Jan 2022 =
* Introduced: whols_registration_fields filter hook
* Added: Additional field support for registration form

= Version: 1.1.2 --Date: 27 Nov 2021 =
* Fixed: Decimal pricing for variation product

= Version: 1.1.1 --Date: 24 Nov 2021 =
* Fixed: Price doesn't show in decimal format problem

= Version: 1.1.0 --Date: 4 Oct 2021 =
* Improved: Enqueueing CSS/JS files considering caching problem 

= Version: 1.0.9 --Date: 13 Sep 2021 =
* Fixed: Plugin does not activate when whols plugin is active
* Added: hook_suffix to load the extension manager js file conditionally

= Version: 1.0.8 --Date: 28 Aug 2021 =
* Fixed: Wholesaler Price Custom Label option doesn't work properly
* Fixed: Wholesaler Price design options doesn't work properly

= Version: 1.0.7 --Date: 1 Aug 2021 =
* Fixed: is wholesale function condition fixed

= Version: 1.0.6 --Date: 24 Jul 2021 =
* Fixed: Role assigning problem
* Fixed: User count column
* Added: Option to disable the wholesale feature
* Fixed: Some other minor issues

= Version: 1.0.4 --Date: 26 may 2021 =
* Added: Pending user count notification into the Whols menu
* Added: Delete wholesaler request when an user deleted manually
* Fixed: Price color does not change issue
* Fixed: Metabox offset warning

= Version: 1.0.0 =
* Initial Release

== Installation ==
This section describes how to install the "Whols" plugin and get it working.

= 1) Install =

i. Go to the WordPress Dashboard "Add New Plugin" section.

ii. Search For "Whols".

iii. Install, then Activate it.

= OR: =

i. Unzip (if it is zipped) and Upload `whols` folder to the `/wp-content/plugins/` directory

ii. Activate the plugin through the 'Plugins' menu in WordPress

= 2) Configure =
i. After install and activate the plugin you will get a notice to install WooCommerce Plugin ( If allready have it then do not show any notice. ).

ii. A new menu called "Whols" will be appear in your dashboard below the "Products" menu

iv. Use the options & configure as your need and that's all!


== Screenshots ==
1. Navigate Settings Quickly After Activating the plugin
2. Wholesaler Registration Form Shortcode
3. Wholesaler Registration Form Frontend
4. Registered Wholesale User Pending for Approval
5. Approve Wholesaler Request
6. General Settings
7. General Settings
8. Product Visibility Settings
8. Registration & Login Settings
9. Registration & Login Settings
11. Guest Access Restriction Settings
12. Other Settings
13. Product Level Settings
14. Wholesale pricing options
15. Wholesale price is now showing in the Frontnd
16. Wholesale price is now showing in the product details page
17. Wholesale pricing options For: Variable Product
18. Wholesale pricing options showing in the product details page For: Variable Product
19. Product Category Settings