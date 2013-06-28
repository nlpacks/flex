{
    "xdsVersion": "2.2.1",
    "frameworkVersion": "ext42",
    "internals": {
        "type": "Ext.form.Panel",
        "reference": {
            "name": "items",
            "type": "array"
        },
        "codeClass": null,
        "userConfig": {
            "height": 250,
            "width": 400,
            "designer|userClassName": "uploadtemplateform",
            "bodyPadding": 10,
            "title": "upload flex template",
            "url": "flextemplateupload.php"
        },
        "cn": [
            {
                "type": "Ext.form.field.File",
                "reference": {
                    "name": "items",
                    "type": "array"
                },
                "codeClass": null,
                "userConfig": {
                    "layout|anchor": "100%",
                    "designer|userClassName": "MyFileUpload",
                    "fieldLabel": "flex template",
                    "name": "flextemplate"
                }
            },
            {
                "type": "Ext.form.field.TextArea",
                "reference": {
                    "name": "items",
                    "type": "array"
                },
                "codeClass": null,
                "userConfig": {
                    "layout|anchor": "100%",
                    "designer|userClassName": "MyTextArea",
                    "fieldLabel": "description",
                    "name": "templatedescription"
                }
            },
            {
                "type": "Ext.button.Button",
                "reference": {
                    "name": "items",
                    "type": "array"
                },
                "codeClass": null,
                "userConfig": {
                    "designer|userClassName": "MyButton1",
                    "text": "upload"
                }
            }
        ]
    },
    "linkedNodes": {},
    "boundStores": {},
    "boundModels": {}
}