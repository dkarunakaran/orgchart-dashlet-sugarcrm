# Tree chart in SugarCRM v7

This will reuse existing NVD3.JS plugin provided by SugarCRM. Javasctipt file of the dashlet can inherit the this.chart property and initalize it with appropriate NVD3 model. This chart is a tree structure, so the script uses the tree model provided by the NVD3.

All the dependencies of chart creation is included automatically by Sugar, you just need to intialise and add properties of appropriate model.

This tree chart is based on Contacts related to Accounts and Opportunities. This dashlet can be added to the record view of Accounts record and Opportunities record.
This will then give a tree structure based on contacts and it's "report to" field related to the Accounts or Opportunities


### How to add the dashlet:
1) Copy all the files in html folder to the same location in your site

2) Add below css to custom/themes/custom.less
```
.nv-chart-org .nv-org-node text.nv-org-name {
	fill: #000;
}
.nv-chart-org .nv-org-node text.nv-org-title {
    fill: #000;
}
```
