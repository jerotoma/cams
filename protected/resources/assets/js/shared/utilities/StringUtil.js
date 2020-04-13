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
            concatString(values) {
              let concatString = '';
                if (_.isArray(values)) {
                    for (var i = 0; i < values.length; i++) {

                        if (i == 0) {
                            concatString = this.capitalize(values[i]);
                        } else {
                            if (values.length - i !== 1) {
                                concatString.concat(this.capitalize(values[i])).concat(',');
                            } else {
                                concatString.concat(this.capitalize(values[i]));
                            }
                        }
                    }
                    return concatString;
                } else {
                    return values
                }
            }

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
