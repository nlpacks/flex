/*
 * File: app/view/fileexplorer.js
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

Ext.define('MyApp.view.fileexplorer', {
    extend: 'Ext.container.Viewport',

    layout: {
        type: 'border'
    },

    initComponent: function() {
        var me = this;

        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'panel',
                    floatable: false,
                    region: 'center',
                    autoRender: true,
                    id: 'actionpanel',
                    autoScroll: true,
                    layout: {
                        align: 'stretch',
                        type: 'vbox'
                    },
                    collapseFirst: false,
                    collapsed: false,
                    title: 'My Panel',
                    titleCollapse: true
                },
                {
                    xtype: 'treepanel',
                    collapseMode: 'header',
                    region: 'west',
                    split: true,
                    id: 'filetreepanel',
                    width: 338,
                    title: 'My Tree Panel',
                    rowLines: true,
                    store: 'FileTreeStore',
                    folderSort: true,
                    listeners: {
                        itemclick: {
                            fn: me.onFiletreepanelItemClick,
                            scope: me
                        },
                        itemexpand: {
                            fn: me.onFiletreepanelItemExpand,
                            scope: me
                        }
                    }
                }
            ]
        });

        me.callParent(arguments);
    },

    onFiletreepanelItemClick: function(dataview, record, item, index, e, eOpts) {

        var path;

        if (record.isRoot())
        path = '/home/roger/documents/flex/flex';
        else
        path = record.get('path');  


        if (record.get('leaf') === false)
        {
            record.expand();
            return;
        }


        if (record.getDepth() ==3 &&  record.get('text')=='customconfig')
        {
            Ext.Ajax.request({
                url: 'sqlite.php',
                method: 'POST',
                params: { 'path': path },
                success: function(response,options) {

                    var actionpanel=Ext.getCmp('actionpanel');
                    actionpanel.removeAll();

                    var rtext=Ext.JSON.decode(response.responseText); 
                    // rtext is an array set, and it's element is JSON object instance


                    for (var arraykey in rtext)
                    {   
                        var jdata=rtext[arraykey] ; 

                        var p = Ext.create('Ext.grid.Panel', {
                            title: jdata,
                            animCollapse: false,
                            collapsible: true,
                            titleCollapse: true,
                            collapsed: true,                   
                            columns: [  ]
                        });                    


                        p.on('expand',function(panel) {              

                            Ext.Ajax.request({
                                url: 'sqlitedata.php',
                                method: 'POST',
                                params: { 'path': path,'table': panel.title },
                                callback: function(options,success,response) {
                                    var strT=response.responseText;
                                    var json=Ext.JSON.decode(strT.replace(/\"\{/g,"{").replace(/\}\"/g,"}")); 

                                    var store=Ext.create('Ext.data.Store',{
                                        fields : json.fields,
                                        data: json.data
                                    });
                                    panel.reconfigure(store,json.columns);
                                    //  panel.render();
                                }
                            });
                            panel.expand();
                        });
                        actionpanel.add(p);
                    }

                },
                failure: function(response,options){Ext.Msg.alert('ajax','failure');}
            });

        }
    },

    onFiletreepanelItemExpand: function(nodeinterface, eOpts) {
        var actionpanel=Ext.getCmp('actionpanel');
        actionpanel.removeAll();

        if (nodeinterface.isRoot())
        path = '/home/roger/documents/flex/flex';
        else
        path = nodeinterface.get('path');  


        //Ext.MessageBox.alert('item click', 'item click');
        if (nodeinterface.get('leaf') === true)
        return;




        Ext.Ajax.request({
            url: 'filenodes.php',
            method: 'POST',
            params: { 'path': path },
            success: function(response,options) {

                var rtext=Ext.JSON.decode(response.responseText); 
                // rtext is an array set, and it's element is JSON object instance

                if (Ext.isEmpty(rtext)===true)
                {
                    nodeinterface.loaded=true;            
                }
                else
                {
                    nodeinterface.removeAll();
                    nodeinterface.appendChild(rtext);            
                    //record.getOwnerTree().getStore().sync();    
                    nodeinterface.expand();

                    // init the file grid data            

                    Ext.Ajax.request({
                        url: 'fileinfo.php',
                        method: 'POST',
                        params: { 'path': path },
                        success: function(response,options) {

                            var infotext=Ext.JSON.decode(response.responseText); 
                            var showfiles=new Ext.create('MyApp.view.FileGridPanel');            
                            showfiles.getStore().removeAll();
                            if (Ext.isEmpty(infotext)===false)
                            {   
                                showfiles.getStore().loadData(infotext);
                                showfiles.getView().refresh();
                            }    
                            actionpanel.add(showfiles);
                        },
                        failure: function(response,options){Ext.Msg.alert('ajax','failure');}
                    });            
                }        
            },
            failure: function(response,options){Ext.Msg.alert('ajax','failure');}
        });
    }

});