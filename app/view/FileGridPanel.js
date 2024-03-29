/*
 * File: app/view/FileGridPanel.js
 *
 * This file was generated by Sencha Architect version 2.2.2.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 4.2.x library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 4.2.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('MyApp.view.FileGridPanel', {
    extend: 'Ext.grid.Panel',

    id: 'showfiles',
    title: 'My Grid Panel',
    store: 'FileArrayStore',

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            columns: [
                {
                    xtype: 'gridcolumn',
                    width: 264,
                    dataIndex: 'name',
                    text: 'name'
                },
                {
                    xtype: 'numbercolumn',
                    width: 138,
                    dataIndex: 'size',
                    text: 'size'
                },
                {
                    xtype: 'datecolumn',
                    width: 307,
                    dataIndex: 'lastmodify',
                    text: 'date modify',
                    format: 'Y-m-d H:i:s'
                }
            ],
            selModel: Ext.create('Ext.selection.CheckboxModel', {
                showHeaderCheckbox: true
            })
        });

        me.callParent(arguments);
    }

});