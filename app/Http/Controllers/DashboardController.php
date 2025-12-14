<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk dashboard
        $queueData = [
            'currentQueueNumber' => 12,
            'myQueueNumber' => 16,
            'estimatedTimePerPerson' => 5,
            'queuePrefix' => 'A'
        ];
        
        // Data UMKM
        $umkms = [
            [
                'name' => 'KFC - PASARAYA MANGGARAI',
                'location' => 'Jl. Pasaraya Manggarai No. 12, Jakarta Selatan',
                'category' => 'Fast Food',
                'status' => 'open', // 'open' atau 'closed'
                'logo' => 'https://upload.wikimedia.org/wikipedia/id/thumb/5/5f/KFC_logo_%282015%29.svg/2560px-KFC_logo_%282015%29.svg.png',
                'distance' => '1.5 km',
                'promos' => [
                    [
                        'name' => 'Super Treat',
                        'price' => 'Rp 90.000',
                        'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                    [
                        'name' => 'Winger Splash Deal',
                        'price' => 'Rp 75.000',
                        'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                ]
            ],
            [
                'name' => 'Warung Makan Sederhana',
                'location' => 'Jl. Mangga Besar No. 45, Jakarta Pusat',
                'category' => 'Masakan Indonesia',
                'status' => 'open',
                'logo' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'distance' => '0.8 km',
                'promos' => [
                    [
                        'name' => 'Nasi Goreng Spesial',
                        'price' => 'Rp 25.000',
                        'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                    [
                        'name' => 'Soto Ayam',
                        'price' => 'Rp 20.000',
                        'image' => 'https://images.unsplash.com/photo-1578474846511-04ba529f0b88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                ]
            ],
            [
                'name' => 'Kopi Teman Sejati',
                'location' => 'Jl. Sudirman No. 78, Jakarta Selatan',
                'category' => 'Coffee Shop',
                'status' => 'open',
                'logo' => 'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'distance' => '1.2 km',
                'promos' => [
                    [
                        'name' => 'Espresso Double',
                        'price' => 'Rp 25.000',
                        'image' => 'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                    [
                        'name' => 'Cappuccino Special',
                        'price' => 'Rp 30.000',
                        'image' => 'https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                ]
            ],
            [
                'name' => 'Martabak Manis 89',
                'location' => 'Jl. Sudirman No. 123, Jakarta Selatan',
                'category' => 'Martabak',
                'status' => 'closed',
                'logo' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80',
                'distance' => '2.1 km',
                'promos' => [
                    [
                        'name' => 'Martabak Coklat Keju',
                        'price' => 'Rp 45.000',
                        'image' => 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                    [
                        'name' => 'Martabak Kacang',
                        'price' => 'Rp 40.000',
                        'image' => 'https://images.unsplash.com/photo-1565299632130-7c3c5c1d6c9d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=300&q=80'
                    ],
                ]
            ],
        ];
        
        return view('backend.dashboard.index', compact('queueData', 'umkms'));
    }
}