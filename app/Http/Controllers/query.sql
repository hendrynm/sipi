<-- -----------------------------BULAN JANUARI-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 01 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung





<-- -----------------------------BULAN FEBRUARI-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 02 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN MARET-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 03 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN APRIL-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 04 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN MEI-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 05 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN JUNI-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 06 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN JULI-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 07 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN AGUSTUS-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 08 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung







<-- -----------------------------BULAN SEPTEMBER-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 09 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung




<-- -----------------------------BULAN OKTOBER-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 10 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung






<-- -----------------------------BULAN NOVEMBER-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 11 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung






<-- -----------------------------BULAN DESEMBER-------------------------------------------------------- -->

SELECT kabupaten.nama_kabupaten as kabupaten, 
    puskesmas.nama_puskesmas as puskesmas, 
    kampung.nama_kampung as kampung,

    kampung.bayi_lahir_L as sasaran_bayi_lahir_L,
    kampung.bayi_lahir_P as sasaran_bayi_lahir_P,
    (kampung.bayi_lahir_L+kampung.bayi_lahir_P) as total_sasaran_bayi_lahir,

    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP1, 
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total1,
    SUM(CASE WHEN antigen.id_antigen=1 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total1,


    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP2, 
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total2,
    SUM(CASE WHEN antigen.id_antigen=2 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total2,


    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.bayi_lahir_L*100 as persen_jumlahL3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP3, 
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.bayi_lahir_P*100 as persen_jumlahP3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total3,
    SUM(CASE WHEN antigen.id_antigen=3 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.bayi_lahir_L+kampung.bayi_lahir_P)*100 as persen_total3,

    kampung.surviving_infant_L as sasaran_si_L,
    kampung.surviving_infant_P as sasaran_si_P,
    (kampung.surviving_infant_L+kampung.surviving_infant_P) as total_sasaran_si,

    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP4, 
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total4,
    SUM(CASE WHEN antigen.id_antigen=4 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total4,


    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP5, 
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total5,
    SUM(CASE WHEN antigen.id_antigen=5 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total5,



    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP6, 
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total6,
    SUM(CASE WHEN antigen.id_antigen=6 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total6,



    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP7, 
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total7,
    SUM(CASE WHEN antigen.id_antigen=7 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total7,



    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP8, 
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total8,
    SUM(CASE WHEN antigen.id_antigen=8 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total8,



    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP9, 
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total9,
    SUM(CASE WHEN antigen.id_antigen=9 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total9,



    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP10, 
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total10,
    SUM(CASE WHEN antigen.id_antigen=10 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total10,



    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.surviving_infant_L*100 as persen_jumlahL11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP11, 
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.surviving_infant_P*100 as persen_jumlahP11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total11,
    SUM(CASE WHEN antigen.id_antigen=11 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.surviving_infant_L + kampung.surviving_infant_P)*100 as persen_total11,

    kampung.baduta_L as sasaran_baduta_L,
    kampung.baduta_P as sasaran_baduta_P,
    (kampung.baduta_L+kampung.baduta_P) as total_sasaran_baduta,

    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP12, 
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total12,
    SUM(CASE WHEN antigen.id_antigen=12 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total12,


    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.baduta_L*100 as persen_jumlahL13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP13, 
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.baduta_P*100 as persen_jumlahP13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total13,
    SUM(CASE WHEN antigen.id_antigen=13 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.baduta_L+kampung.baduta_P)*100 as persen_total13,

    kampung.sd_1_L as sasaran_sd_1_L,
    kampung.sd_1_P as sasaran_sd_1_P,
    (kampung.sd_1_L+kampung.sd_1_P) as total_sasaran_sd_1,

    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP14, 
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total14,
    SUM(CASE WHEN antigen.id_antigen=14 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total14,


    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_1_L*100 as persen_jumlahL15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP15, 
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_1_P*100 as persen_jumlahP15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total15,
    SUM(CASE WHEN antigen.id_antigen=15 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_1_L + kampung.sd_1_P)*100 as persen_total15,

    kampung.sd_2_L as sasaran_sd_2_L,
    kampung.sd_2_P as sasaran_sd_2_P,
    (kampung.sd_2_L+kampung.sd_2_P) as total_sasaran_sd_2,

    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_2_L*100 as persen_jumlahL16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP16, 
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_2_P*100 as persen_jumlahP16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total16,
    SUM(CASE WHEN antigen.id_antigen=16 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_2_L + kampung.sd_2_P)*100 as persen_total16,

    kampung.sd_5_L as sasaran_sd_5_L,
    kampung.sd_5_P as sasaran_sd_5_P,
    (kampung.sd_5_L+kampung.sd_5_P) as total_sasaran_sd_5,

    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP17, 
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total17,
    SUM(CASE WHEN antigen.id_antigen=17 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total17,


    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_5_L*100 as persen_jumlahL18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP18, 
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_5_P*100 as persen_jumlahP18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total18,
    SUM(CASE WHEN antigen.id_antigen=18 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_5_L + kampung.sd_5_P)*100 as persen_total18,

    kampung.sd_6_L as sasaran_sd_6_L,
    kampung.sd_6_P as sasaran_sd_6_P,
    (kampung.sd_6_L+kampung.sd_6_P) as total_sasaran_sd_6,

    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END) as jumlahL19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'L' THEN 1 ELSE 0 END)/kampung.sd_6_L*100 as persen_jumlahL19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END) as jumlahP19, 
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm AND data_individu.jenis_kelamin = 'P' THEN 1 ELSE 0 END)/kampung.sd_6_P*100 as persen_jumlahP19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END) as total19,
    SUM(CASE WHEN antigen.id_antigen=19 AND imunisasi.status='sudah' AND MONTH(imunisasi.tanggal_pemberian) = 12 AND YEAR(imunisasi.tanggal_pemberian) = $tahunForm THEN 1 ELSE 0 END)/(kampung.sd_6_L + kampung.sd_6_P)*100 as persen_total19
    

FROM kampung 
    LEFT JOIN data_individu ON data_individu.id_kampung = kampung.id_kampung
    LEFT JOIN imunisasi ON imunisasi.id_anak = data_individu.id_anak
    LEFT JOIN antigen ON imunisasi.id_antigen = antigen.id_antigen
    LEFT JOIN puskesmas ON puskesmas.id_puskesmas = kampung.id_puskesmas
    LEFT JOIN kabupaten ON kabupaten.id_kabupaten = puskesmas.id_kabupaten
WHERE kabupaten.id_kabupaten = $kabupatenForm
    AND puskesmas.id_puskesmas = $puskesmasForm
GROUP BY kampung.id_kampung
ORDER BY kampung.id_kampung









