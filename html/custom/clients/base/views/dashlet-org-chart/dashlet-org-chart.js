({
    plugins: ['Dashlet', 'Chart'],

    /**
	* {@inheritDocs}
	*/
	initialize: function(options)
	{
		this._super('initialize', [options]);
	},

	/**
     * @inheritDoc
     */
    initDashlet: function(view) {

		var nodeRenderer = function(content, d, w, h) {
		  var node = content.append('g').attr('class', 'nv-org-node');
		      node.append('rect').attr('class', 'nv-org-bkgd')
		        .attr('x', 0)
		        .attr('y', 0)
		        .attr('rx', 2)
		        .attr('ry', 2)
		        .attr('width', w)
		        .attr('height', h)
		        .attr('fill', d.level);
		      node.append('text').attr('class', 'nv-org-name')
		        .attr('data-url', d.url)
		        .attr('transform', 'translate(24, 14)')
		        .text(d.name);
		      node.append('text').attr('class', 'nv-org-title')
		        .attr('transform', 'translate(24, 24)')
		        .text(d.title);
		    return node;
		};

		this.chart = nv.models.tree()
		.duration(500)
		.nodeSize({'width': 124, 'height': 56})
		.nodeRenderer(nodeRenderer)
		.zoomExtents({'min': 1, 'max': 4})
		.horizontal(true);
    },

    /**
     * Generic method to render chart with check for visibility and data.
     * Called by _renderHtml and loadData.
     */
    renderChart: function() {
    },

  	/**
  	* {@inheritDocs}
  	*/
  	loadData: function(options)
  	{
  		options = options || {};
  		var self = this;
          if(typeof this.model.attributes._module != "undefined"){
              var apiURL = app.api.buildURL('Contacts/org_chart_data/'+this.model.attributes._module+"/"+this.model.get('id'));
              app.api.call('read', apiURL, null, {
                  success: _.bind(function(result)
                  {
                      if(typeof result.content != "undefined"){

                          // Clear out the current chart before a re-render
                          self.$('svg#' + self.cid).children().remove();

                          // Load data into chart model and set reference to chart
                          d3.select('svg#' + self.cid)
                            .datum(result.content)
                            .transition().duration(500)
                            .call(self.chart);
                            self.chart.update();
                      }
                  }, this),
                  error: function(error)
                  {
                      app.alert.show("server-error", {
                          level: 'error',
                          messages: 'ERR_GENERIC_SERVER_ERROR',
                          autoClose: false
                      });
                      app.error.handleHttpError(error);
                  },
                  complete: options ? options.complete : null
              });
          }
  	},

})