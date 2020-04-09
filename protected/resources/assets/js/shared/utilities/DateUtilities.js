const DatePlugin = {
    install(Vue) {
      Vue.mixin({
        data() {
          return {

          };
        },
        methods: {
            generatePassedYears(startYear) {
                var currentYear = new Date().getFullYear(), years = [];
                startYear = startYear || 1980;
                while ( startYear <= currentYear ) {
                    years.push(startYear++);
                }
                return years;
            },
            generateFutureYears(numYears = 9) {
                var min = new Date().getFullYear(),
                    max = min + numYears, years = [];;
                    for (var i = min; i <= max; i++){
                        years.push(i);
                    }
                return years;
            }
        }
      });
      Object.defineProperty(Vue.prototype, "$dateUtil", {
        get() {
          return this.$root;
        }
      });
    }
  };
  export default DatePlugin;

