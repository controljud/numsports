<script>
  import { Line } from "vue-chartjs";

  export default {
    extends: Line,

    props: [
      'graphLabels', 'graphDataset'
    ],

    methods: {
      render: function() {
        this.renderChart(
          {
            labels: this.graphLabels,
            datasets: this.graphDataset
          },
          {
            scales: {
              yAxes: [{
                ticks: {
                  reverse: true,
                  beginAtZero: true
                }
              }]
            },
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: true,
              position: 'right',
              labels: {
                fontSize: 10,
                padding: 8.5
              }
            }
          }
        );
      },

      unSelectAll: function() {
        this.graphDataset.forEach(function(ds) {
          //ds._meta.hide();
          //console.log(ds);
          //ds.label.hidden = true;
        });
        // this.graphDataset.forEach(function(ds) {
        //   ds._meta[0].hidden = true;
        // });
        // this.datasets.foreach(function(ds) {
        //   ds.hidden = !ds.hidden;
        // });
      },

      selectAll: function() {

      }
    },

    mounted() {
      this.render();
    }
  };
</script>