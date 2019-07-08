let bundle = NSBundle.mainBundle()
let path = bundle.pathForResource("data", ofType: "json")
var error:NSError?
if let content = NSString.stringWithContentsOfFile(path, encoding: NSUTF8StringEncoding, error: &error) {
println(content) // prints the content of data.json
}

but if you wanted to transform the JSON into data you'd do something like this:

let bundle = NSBundle.mainBundle()
let path = bundle.pathForResource("data", ofType: "json")
var error:NSError?
var data:NSData = NSData(contentsOfFile: path)
let json:AnyObject = NSJSONSerialization.JSONObjectWithData(data, options: NSJSONReadingOptions.AllowFragments, error:&error)
 // JSONObjectWithData returns AnyObject so the first thing to do is to downcast this to a known type
if let nsDictionaryObject = json as? NSDictionary {
        if let swiftDictionary = nsDictionaryObject as Dictionary? {
            println(swiftDictionary)
    }
}
else if let nsArrayObject = json as? NSArray {
       if let swiftArray = nsArrayObject as Array? {
           println(swiftArray)
      }
 }