//
//  NextPageViewController.swift
//  1011LoginDemo
//
//  Created by 黃筱珮 on 2022/10/21.
//

import UIKit

class NextPageViewController: UIViewController {

    @IBOutlet weak var nextPageLabel: UILabel!
    
    var dataText: String!
    
    override func viewDidLoad() {
        super.viewDidLoad()

        print(dataText)
        nextPageLabel.text = dataText
        print("2")
        
    }
    
    @IBAction func clossesButton(_ sender: Any) {
        self.dismiss(animated: true)
    }
    
    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */

}
