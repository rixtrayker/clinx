jQuery.extend(jQuery.validator.messages, {
    required: "هذا الحقل مطلوب",
    remote: "Please fix this field.",
    email: "إيميل غير صحيح",
    url: "قم بإدخال لينك صحيح",
    date: "قم بإدخال تاريخ صحيح",
    dateISO: "قم بإدخال تاريخ صحيح",
    number: "قم بإدخال رقم",
    digits: "قم بإدخال أرقام",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "من فضلك قم بإدخال نفس القيمة",
    accept: "من فضلك قم برفع إمتداد صحيح",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});
