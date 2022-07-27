<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
        'signup' => array(
                array(
                        'field' => 'username',
                        'label' => 'Username',
                        'rules' => 'required|alpha_numeric|min_length[5]|max_length[12]|is_unique[tbl_login_details.user_name]',
                                'required'      => 'You have not provided %s.',
                                'is_unique'     => 'This %s already exists.'
                        
                ),
                array(
                        'field' => 'pass',
                        'label' => 'Password',
                        'rules' => 'required'
                ),
                 array(
                        'field' => 'cpass',
                        'label' => 'Password Confirmation',
                        'rules' => 'required|matches[pass]'
                ),
                array(
                        'field' => 'fullname',
                        'label' => 'Fullname',
                        'rules' => 'required'
                ),
               
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email|is_unique[tbl_login_details.email]'
                ),
                 array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'required'
                ),
                  array(
                        'field' => 'contact',
                        'label' => 'Contact',
                        'rules' => 'required'
                )
        ),
        'logincheck'=> array(
                array(
                        'field' => 'username',
                        'label' => 'Username',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                array(
                        'field' => 'pass',
                        'label' => 'Password',
                        'rules' => 'required'
                )
        ),
        'addpropertyarea'=>array(
                        array(
                        'field' => 'prop_area',
                        'label' => 'Property Area',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                )

        ),
        'addpropertytype'=>array(
                        array(
                        'field' => 'prop_type',
                        'label' => 'Property Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                )

        ),
        'addtypecategory'=>array(
                        array(
                        'field' => 'category_name',
                        'label' => 'Type Category',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                array(
                        'field' => 'prop_type',
                        'label' => 'Property Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                )

        ),

        'addproperty'=> array(
                array(
                        'field' => 'prop_name',
                        'label' => 'Property Name',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                array(
                        'field' => 'prop_status',
                        'label' => 'Property Status',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                 array(
                        'field' => 'prop_area',
                        'label' => 'Property Area',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                  array(
                        'field' => 'prop_type',
                        'label' => 'Property Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                   array(
                        'field' => 'type_category',
                        'label' => 'Property Type Category',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                    array(
                        'field' => 'prop_city',
                        'label' => 'City',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                  array(
                        'field' => 'prop_owner',
                        'label' => 'Property Owner',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                  array(
                        'field' => 'prop_location',
                        'label' => 'Property Location',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                ),
                  array(
                        'field' => 'prop_value',
                        'label' => 'Property Value',
                        'rules' => 'required',
                        'required'      => 'You have not provided %s.'
                )

        ),
        'addbooking'=> array(
                array(
                        'field' => 'property_name',
                        'label' => 'Property Name',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                 
                  array(
                        'field' => 'buyer',
                        'label' => 'Buyer Name',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                    array(
                        'field' => 'chk',
                        'label' => 'Select Broker Option',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                    array(
                        'field' => 'payment_method',
                        'label' => 'Payment Method',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                     array(
                        'field' => 'payment_type',
                        'label' => 'Payment Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                )
        ),
        'addinstallment'=> array(
                array(
                        'field' => 'payment_id',
                        'label' => 'Payment ID',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                 
                  array(
                        'field' => 'installment_no',
                        'label' => 'Installment No',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                    array(
                        'field' => 'installment_amount',
                        'label' => 'Installment Amount',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                )
        ),
        'addpayment'=> array(
                array(
                        'field' => 'payment_method',
                        'label' => 'Payment Method',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                 
                  array(
                        'field' => 'payment_type',
                        'label' => 'Payment Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                )
        ),
        'addrent'=> array(
                array(
                        'field' => 'rentamount',
                        'label' => 'Rent Amount',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                 
                  array(
                        'field' => 'pay_id',
                        'label' => 'Payment ID',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                  array(
                        'field' => 'book_id',
                        'label' => 'Booking ID',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                )
        ),
        'addusers' => array(
                array(
                        'field' => 'user_name',
                        'label' => 'Username',
                        'rules' => 'required|alpha_numeric|min_length[2]|max_length[12]|is_unique[tbl_login_details.user_name]',
                                'required'      => 'You have not provided %s.',
                                'is_unique'     => 'This %s already exists.'
                        
                ),
                array(
                        'field' => 'user_type',
                        'label' => 'User Type',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'full_name',
                        'label' => 'Fullname',
                        'rules' => 'required'
                ),
               
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email|is_unique[tbl_login_details.email]'
                ),
                 array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'required'
                ),
                  array(
                        'field' => 'contact_no',
                        'label' => 'Contact',
                        'rules' => 'required'
                )
        ),
        'addproject'=> array(
                array(
                        'field' => 'project_title',
                        'label' => 'Project Title',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                 
                  array(
                        'field' => 'project_description',
                        'label' => 'Project Description',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                  array(
                        'field' => 'status',
                        'label' => 'Status',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                  array(
                        'field' => 'owner_id',
                        'label' => 'Owner',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                ),
                   array(
                        'field' => 'project_type_id',
                        'label' => 'Project Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                )
        ),
        'contactUs' => array(
                array(
                        'field' => 'full_name',
                        'label' => 'Fullname',
                        'rules' => 'required'
                ),
               
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email'
                ),
                 array(
                        'field' => 'subject',
                        'label' => 'Subject',
                        'rules' => 'required'
                ),
                  array(
                        'field' => 'contact_number',
                        'label' => 'Contact Number',
                        'rules' => 'required'
                ),
                  array(
                        'field' => 'message',
                        'label' => 'Message',
                        'rules' => 'required'
                )
        ),
        'addmaterialtype'=> array(
                array(
                        'field' => 'type_name',
                        'label' => 'Material Type',
                        'rules' => 'required',
                                'required'      => 'You have not provided %s.',
                                
                )
        )
);
?>