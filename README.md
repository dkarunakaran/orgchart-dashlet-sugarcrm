# Orgnaisation chart in SugarCRM v7

This will reuse existing NVD3.JS plugin provided by SugarCRM. Javasctipt file of the dashlet can inherit the this.chart property and initalize it with appropriate NVD3 model. Organization chart is a tree strudture, so the script uses the tree model provided by the NVD3.

All the dependencies of chart creation is included automatically by Sugar, you just need to intialise and add properties of appropriate model.

This Organisation chart is based on Contacts related to Accounts and Opportunities. This dashlet can be added to the record view of Accounts record and Opportunities record.
This will then give a tree structure based on contacts and it's "report to" field related to the Accounts or Opportunities


