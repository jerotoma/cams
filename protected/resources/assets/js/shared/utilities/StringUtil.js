const StringUtilPlugin = {
    install(Vue) {
      Vue.mixin({
        data() {
          return {

          };
        },
        methods: {
            capitalize(value) {
                return _.startCase(_.camelCase(value));
            },
            lowerCase(value) {
                return _.toLower(value);
            },

        }
      });
      Object.defineProperty(Vue.prototype, "$stringUtil", {
        get() {
          return this.$root;
        }
      });
    }
  };
  export default StringUtilPlugin ;
