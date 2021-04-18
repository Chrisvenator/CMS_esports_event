<?php


namespace App\Service;


class Matches {
    public function getMatches() {
        $match = [
            [
                "mode" => "Best of 3",
                "map" => "",
                "date" => "Heute",
                "time" => "Abend",
                "link" => "twitch.tv",
                "teams" => [
                    [
                        "name" => "Lilmix",
                        "members" => [
                            [
                                "name" => "quix",
                                "kpr" => 0.65,
                                "origin" => "Schweden"
                            ], [
                                "name" => "b0denmaster",
                                "kpr" => 0.68,
                                "origin" => "Schweden"
                            ], [
                                "name" => "bq",
                                "kpr" => 0.70,
                                "origin" => "Schweden"
                            ], [
                                "name" => "isak",
                                "kpr" => 0.70,
                                "origin" => "Schweden"
                            ], [
                                "name" => "Svedjehed",
                                "kpr" => 0.69,
                                "origin" => "Schweden"
                            ]
                        ]
                    ],
                    [
                        "name" => "Sengal",
                        "members" => [
                            [
                                "name" => "MAJ3R",
                                "kpr" => 0.65,
                                "origin" => "Türkei"
                            ], [
                                "name" => "paz",
                                "kills per round" => 0.7,
                                "origin" => "Türkei"
                            ], [
                                "name" => "ngiN",
                                "kpr" => 0.62,
                                "origin" => "Türkei"
                            ], [
                                "name" => "l0gicman",
                                "kpr" => 0.64,
                                "origin" => "Türkei"
                            ], [
                                "name" => "imoRR",
                                "kpr" => 0.75,
                                "origin" => "Türkei"
                            ]
                        ]
                    ]
                ]
            ],
            [
                "mode" => "Best of 3",
                "map" => "",
                "date" => "21.April.2021",
                "time" => "11:00",
                "link" => "https://www.hltv.org/live?matchId=2348025",
                "teams" => [
                    [
                        "name" => "R!OT",
                        "members" => [
                            [
                                "name" => "2D",
                                "kpr" => 0.73,
                                "origin" => "Australien"
                            ], [
                                "name" => "cheeseball",
                                "kpr" => 0.62,
                                "origin" => "Australien"
                            ], [
                                "name" => "callum_murray",
                                "kpr" => 0.64,
                                "origin" => "Australien"
                            ], [
                                "name" => "Fiend",
                                "kpr" => 0.65,
                                "origin" => "Australien"
                            ], [
                                "name" => "OMARI",
                                "kpr" => 0.64,
                                "origin" => "Australien"
                            ]
                        ]
                    ],
                    [
                        "name" => "Bizarre",
                        "members" => [
                            [
                                "name" => "moop",
                                "kpr" => 0.63,
                                "origin" => "Australien"
                            ], [
                                "name" => "SkulL",
                                "kpr" => 0.64,
                                "origin" => "Australien"
                            ], [
                                "name" => "asap",
                                "kpr" => 0.83,
                                "origin" => "Australien"
                            ], [
                                "name" => "mizzy",
                                "kpr" => 0.64,
                                "origin" => "Australien"
                            ], [
                                "name" => "guag",
                                "kpr" => 0.63,
                                "origin" => "Australien"
                            ]
                        ]
                    ]
                ]
            ],
            [
                "mode" => "Best of 1",
                "map" => "",
                "date" => "21.April.2021",
                "time" => "...",
                "link" => "https://www.hltv.org/live?matchId=2347953",
                "teams" => [
                    [
                        "name" => "R!OT",
                        "members" => [
                            [
                                "name" => "AJTT",
                                "kpr" => 0.57,
                                "origin" => "Tschechien"
                            ], [
                                "name" => "leckr",
                                "kpr" => 0.63,
                                "origin" => "Tschechien"
                            ], [
                                "name" => "HONES",
                                "kpr" => 0.49,
                                "origin" => "Tschechien"
                            ], [
                                "name" => "capseN",
                                "kpr" => 0.58,
                                "origin" => "Tschechien"
                            ], [
                                "name" => "MoriiSko",
                                "kpr" => 0.58,
                                "origin" => "Tschechien"
                            ]
                        ]
                    ],
                    [
                        "name" => "Anonymo",
                        "members" => [
                            [
                                "name" => "Snax",
                                "kpr" => 0.72,
                                "origin" => "Polen"
                            ], [
                                "name" => "innocent",
                                "kpr" => 0.68,
                                "origin" => "Polen"
                            ], [
                                "name" => "myonio",
                                "kpr" => 0.59,
                                "origin" => "Polen"
                            ], [
                                "name" => "KEi",
                                "kpr" => 0.73,
                                "origin" => "Polen"
                            ], [
                                "name" => "Kylar",
                                "kpr" => 0.66,
                                "origin" => "Polen"
                            ]
                        ]
                    ]
                ]
            ]

        ];
        return $match;

    }
}