//
//  States.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 15/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire

class States {
    
    public static func getAllStates() -> [String] {
        
        let states: Parameters = ["AK": "Alaska",
                                    "AL": "Alabama",
                                    "AR": "Arkansas",
                                    "CA": "California",
                                    "CO": "Colorado",
                                    "CT": "Connecticut",
                                    "DC": "District of Columbia",
                                    "DE": "Delaware",
                                    "FL": "Florida",
                                    "GA": "Georgia",
                                    "HI": "Hawaii",
                                    "IA": "Iowa",
                                    "ID": "Idaho",
                                    "IL": "Illinois",
                                    "IN": "Indiana",
                                    "KS": "Kansas",
                                    "KY": "Kentucky",
                                    "LA": "Louisiana",
                                    "MA": "Massachusetts",
                                    "MD": "Maryland",
                                    "ME": "Maine",
                                    "MI": "Michigan",
                                    "MN": "Minnesota",
                                    "MO": "Missouri",
                                    "MS": "Mississippi",
                                    "MT": "Montana",
                                    "NC": "North Carolina",
                                    "ND": "North Dakota",
                                    "NE": "Nebraska",
                                    "NH": "New Hampshire",
                                    "NJ": "New Jersey",
                                    "NM": "New Mexico",
                                    "NV": "Nevada",
                                    "NY": "New York",
                                    "OH": "Ohio",
                                    "OK": "Oklahoma",
                                    "OR": "Oregon",
                                    "PA": "Pennsylvania",
                                    "RI": "Rhode Island",
                                    "SC": "South Carolina",
                                    "SD": "South Dakota",
                                    "TN": "Tennessee",
                                    "TX": "Texas",
                                    "UT": "Utah",
                                    "VA": "Virginia",
                                    "VT": "Vermont",
                                    "WA": "Washington",
                                    "WI": "Wisconsin",
                                    "WV": "West Virginia",
                                    "WY": "Wyoming"]
        let array = (Array(states.values) as! [String]).sorted()
        var options = ["-select-"]
        options.append(contentsOf: array)
        
        return options
    }
    
    public static func getStateCode(_ name: String) -> String {
        
        let states = ["AK": "Alaska",
                        "AL": "Alabama",
                        "AR": "Arkansas",
                        "CA": "California",
                        "CO": "Colorado",
                        "CT": "Connecticut",
                        "DC": "District of Columbia",
                        "DE": "Delaware",
                        "FL": "Florida",
                        "GA": "Georgia",
                        "HI": "Hawaii",
                        "IA": "Iowa",
                        "ID": "Idaho",
                        "IL": "Illinois",
                        "IN": "Indiana",
                        "KS": "Kansas",
                        "KY": "Kentucky",
                        "LA": "Louisiana",
                        "MA": "Massachusetts",
                        "MD": "Maryland",
                        "ME": "Maine",
                        "MI": "Michigan",
                        "MN": "Minnesota",
                        "MO": "Missouri",
                        "MS": "Mississippi",
                        "MT": "Montana",
                        "NC": "North Carolina",
                        "ND": "North Dakota",
                        "NE": "Nebraska",
                        "NH": "New Hampshire",
                        "NJ": "New Jersey",
                        "NM": "New Mexico",
                        "NV": "Nevada",
                        "NY": "New York",
                        "OH": "Ohio",
                        "OK": "Oklahoma",
                        "OR": "Oregon",
                        "PA": "Pennsylvania",
                        "RI": "Rhode Island",
                        "SC": "South Carolina",
                        "SD": "South Dakota",
                        "TN": "Tennessee",
                        "TX": "Texas",
                        "UT": "Utah",
                        "VA": "Virginia",
                        "VT": "Vermont",
                        "WA": "Washington",
                        "WI": "Wisconsin",
                        "WV": "West Virginia",
                        "WY": "Wyoming"]
        
        if let key = states.key(from: name) {
            return key
        }
        
        return ""
    }
    
    public static func getStateName(_ code: String?) -> String {
        
        let states = ["AK": "Alaska",
                        "AL": "Alabama",
                        "AR": "Arkansas",
                        "CA": "California",
                        "CO": "Colorado",
                        "CT": "Connecticut",
                        "DC": "District of Columbia",
                        "DE": "Delaware",
                        "FL": "Florida",
                        "GA": "Georgia",
                        "HI": "Hawaii",
                        "IA": "Iowa",
                        "ID": "Idaho",
                        "IL": "Illinois",
                        "IN": "Indiana",
                        "KS": "Kansas",
                        "KY": "Kentucky",
                        "LA": "Louisiana",
                        "MA": "Massachusetts",
                        "MD": "Maryland",
                        "ME": "Maine",
                        "MI": "Michigan",
                        "MN": "Minnesota",
                        "MO": "Missouri",
                        "MS": "Mississippi",
                        "MT": "Montana",
                        "NC": "North Carolina",
                        "ND": "North Dakota",
                        "NE": "Nebraska",
                        "NH": "New Hampshire",
                        "NJ": "New Jersey",
                        "NM": "New Mexico",
                        "NV": "Nevada",
                        "NY": "New York",
                        "OH": "Ohio",
                        "OK": "Oklahoma",
                        "OR": "Oregon",
                        "PA": "Pennsylvania",
                        "RI": "Rhode Island",
                        "SC": "South Carolina",
                        "SD": "South Dakota",
                        "TN": "Tennessee",
                        "TX": "Texas",
                        "UT": "Utah",
                        "VA": "Virginia",
                        "VT": "Vermont",
                        "WA": "Washington",
                        "WI": "Wisconsin",
                        "WV": "West Virginia",
                        "WY": "Wyoming"]
        
        if let name = states[code!] {
            return name
        }
        
        return ""
    }

}
