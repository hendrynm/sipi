SELECT kabupaten.nama_kabupaten as kabupaten,
          puskesmas.nama_puskesmas as puskesmas,
          kampung.nama_kampung as kampung,

          kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
          kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
          (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total1,
          ROUND(SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total1,


          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total2,
          ROUND(SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total2,


          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100, 2) as persen_jumlahL3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100, 2) as persen_jumlahP3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total3,
          ROUND(SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100, 2) as persen_total3,

          kampung.surviving_infant_L as sasaran_si_L,
          kampung.surviving_infant_P as sasaran_si_P,
          (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total4,
          ROUND(SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total4,


          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total5,
          ROUND(SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total5,



          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total6,
          ROUND(SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total6,



          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total7,
          ROUND(SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total7,



          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total8,
          ROUND(SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total8,



          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total9,
          ROUND(SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total9,



          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total10,
          ROUND(SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total10,



          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100, 2) as persen_jumlahL11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100, 2) as persen_jumlahP11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total11,
          ROUND(SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100, 2) as persen_total11,

          kampung.baduta_L as sasaran_baduta_L,
          kampung.baduta_P as sasaran_baduta_P,
          (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total12,
          ROUND(SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total12,


          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100, 2) as persen_jumlahL13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100, 2) as persen_jumlahP13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total13,
          ROUND(SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100, 2) as persen_total13,

          kampung.sd_1_L as sasaran_sd_1_L,
          kampung.sd_1_P as sasaran_sd_1_P,
          (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total14,
          ROUND(SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total14,


          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100, 2) as persen_jumlahL15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100, 2) as persen_jumlahP15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total15,
          ROUND(SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100, 2) as persen_total15,

          kampung.sd_2_L as sasaran_sd_2_L,
          kampung.sd_2_P as sasaran_sd_2_P,
          (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100, 2) as persen_jumlahL16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100, 2) as persen_jumlahP16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total16,
          ROUND(SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100, 2) as persen_total16,

          kampung.sd_5_L as sasaran_sd_5_L,
          kampung.sd_5_P as sasaran_sd_5_P,
          (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total17,
          ROUND(SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total17,


          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100, 2) as persen_jumlahL18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100, 2) as persen_jumlahP18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total18,
          ROUND(SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100, 2) as persen_total18,

          kampung.sd_6_L as sasaran_sd_6_L,
          kampung.sd_6_P as sasaran_sd_6_P,
          (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END), 0) as jumlahL19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100, 2) as persen_jumlahL19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END), 0) as jumlahP19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100, 2) as persen_jumlahP19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END), 0) as total19,
          ROUND(SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = 2012 THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100, 2) as persen_total19


          FROM kampung
              LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
              LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
              LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
              LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
              LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
          WHERE kabupaten.id_kabupaten = 1
              AND puskesmas.id_puskesmas = 1
          GROUP BY kampung.id_kampung
          ORDER BY kampung.id_kampung