<?php
require_once('classes/StickyForm.php');

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => null,//if this is set to null then the default error message will appear
        'error' => '',
        'required' => true,
        'value' => ''
    ],
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name.',
        'error' => '',
        'required' => false,
        'value' => ''
    ],
    'address' => [
        'type' => 'text',
        'regex' => 'address',
        'label' => 'Address',
        'name' => 'address',
        'id' => 'address',
        'errorMsg' => 'You must enter a valid address.',
        'error' => '',
        'required' => false,
        'value' => '123 Anyplace'
    ],
    'state' => [
        'type' => 'select',
        'label' => 'State',
        'name' => 'state',
        'id' => 'state',
        'errorMsg' => 'You must select a state.',
        'error' => '',
        'selected' => 'mi',
        'required' => true,
        'options' => [
            '0' => 'Please Select a State',//The zero entry tells the script that no value was selected.
            'ca' => 'California',
            'tx' => 'Texas',
            'mi' => 'Michigan',
            'ny' => 'New York',
            'fl' => 'Florida'
        ]
    ],
    'zip_code' => [
        'type' => 'text',
        'regex' => 'zip',
        'label' => 'Zip Code',
        'name' => 'zip_code',
        'id' => 'zip_code',
        'errorMsg' => 'You must enter a valid zip code.',
        'error' => '',
        'required' => false,
        'value' => '12345'
    ],
    'phone' => [
        'type' => 'text',
        'regex' => 'phone',
        'label' => 'Phone',
        'name' => 'phone',
        'id' => 'phone',
        'errorMsg' => 'You must enter a valid phone number.',
        'error' => '',
        'required' => false,
        'value' => '999.999.9999'
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'error' => '',
        'required' => false,
        'value' => 'sshaper@wccnet.edu'
    ],
    'comments' => [
        'type' => 'textarea',
        'regex' => 'none',
        'label' => 'Comments',
        'name' => 'comments',
        'id' => 'comments',
        'errorMsg' => '',
        'error' => '',
        'required' => false,
        'value' => 'Hello Class'
    ],
    'radio_options' => [
        'type' => 'radio',
        'label' => 'Choose an Option',
        'name' => 'radio_options',
        'id' => 'radio_options',
        'errorMsg' => 'You must select an option.',
        'error' => '',
        'required' => true,
        'options' => [
            ['value' => 'option1', 'label' => 'Option 1', 'checked' => false],
            ['value' => 'option2', 'label' => 'Option 2', 'checked' => false],
            ['value' => 'option3', 'label' => 'Option 3', 'checked' => false]
        ],
        'layout' => 'horizontal'
    ],
    'checkboxes' => [
        'type' => 'checkbox',
        'label' => 'Select Items',
        'name' => 'checkboxes',
        'id' => 'checkboxes',
        'errorMsg' => 'You must select at least one item.',
        'error' => '',
        'required' => false,
        'options' => [
            ['value' => 'item1', 'label' => 'Item 1', 'checked' => false],
            ['value' => 'item2', 'label' => 'Item 2', 'checked' => false],
            ['value' => 'item3', 'label' => 'Item 3', 'checked' => false],
            ['value' => 'item4', 'label' => 'Item 4', 'checked' => false],
            ['value' => 'item5', 'label' => 'Item 5', 'checked' => false]
        ],
        'layout' => 'horizontal'
    ],
    
    'masterStatus' => [
        'error' => false
    ]

];


// Initialize StickyForm instance
$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);
    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
        /*
        If no errors then process the form data

        ... process code goes here....

        NOTE: If you need to get the form values to put into a database just get them from the  $_POST array below is an example of the complete array:

        Array
            (
                [first_name] => Scott
                [last_name] => Shaper
                [address] => 123 Anyplace
                [state] => mi
                [zip_code] => 12345
                [phone] => 999.999.9999
                [email] => sshaper@wccnet.edu
                [comments] => Hello Class
                [radio_options] => option2
                [checkboxes] => Array
                    (
                        [0] => item2
                        [1] => item3
                    )

            )    
        
        If you wanted to get a specific field value (say first name) you would say $_POST['first_name']
 
        */
        //echo "scott";
        echo '<pre>';
        print_r($_POST);
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sticky Form Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <form method="post" action="">
        <div class="row">
            <!-- Render first name field -->
            <div class="col-md-6">
                <?php echo $stickyForm->renderInput($formConfig['first_name'], 'mb-3'); ?>
            </div>

            <!-- Render last name field -->
            <div class="col-md-6">
                <?php echo $stickyForm->renderInput($formConfig['last_name'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Render address field -->
        <div class="row">
            <div class="col-md-12">
                <?php echo $stickyForm->renderInput($formConfig['address'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Render zip code, phone, and email fields -->
        <div class="row">
            <!-- Render state select box -->
            <div class="col-md-3">
                <?php echo $stickyForm->renderSelect($formConfig['state'], 'mb-3'); ?>
            </div>
            <div class="col-md-3">
                <?php echo $stickyForm->renderInput($formConfig['zip_code'], 'mb-3'); ?>
            </div>
            <div class="col-md-3">
                <?php echo $stickyForm->renderInput($formConfig['phone'], 'mb-3'); ?>
            </div>
            <div class="col-md-3">
                <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Render comments textarea -->
        <div class="row">
            <div class="col-md-12">
                <?php echo $stickyForm->renderTextarea($formConfig['comments'], 'mb-3'); ?>
            </div>
        </div>

        <!-- Render radio options -->
        <div class="row">
            <div class="col-md-12">
                <?php echo $stickyForm->renderRadio($formConfig['radio_options'], 'mb-3', $formConfig['radio_options']['layout']); ?>
            </div>
        </div>

        <!-- Render checkboxes -->
        <div class="row">
            <div class="col-md-12">
                <?php echo $stickyForm->renderCheckboxGroup($formConfig['checkboxes'], 'mb-3', $formConfig['checkboxes']['layout']); ?>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
</div>

</body>
</html>
