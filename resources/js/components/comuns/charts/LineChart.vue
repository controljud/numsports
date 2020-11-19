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
              position: 'bottom'
            }
            // title: {
            //   display: true,
            //   text: "My Data"
            // }
          }
        );
      }
    },

    mounted() {
      this.render();
    }
  };
</script>