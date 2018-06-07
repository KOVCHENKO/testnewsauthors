export default class DataFormatter {

    static snakeCaseStr(str) {
        return str.replace(/([A-Z])/g, '_$1').toLowerCase();
    }

    static camelCaseStr(str) {
        return str.replace(/_([a-z])/g, function (m, w) {
            return w.toUpperCase();
        });
    }
}