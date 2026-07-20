<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">

<style>
    *{
    margin:0;
    padding:0;
    box-sizing:border-box;
    }
    body{
    font-family:DejaVu Sans,sans-serif;
    background:#ECECEC;
    padding:20px;
    }
    .cv{
    width:210mm;
    height:297mm;
    background:white;
    margin:auto;
    overflow:hidden;
    position:relative;
    }
/* ================= HEADER ================= */

    .header{
    height:185px;
    background:#c4fcff;
    position:relative;
    padding:35px 45px;
    }
    /* watermark */
    .header:before{
    content:"";
    position:absolute;
    width:240px;
    height:240px;
    border-radius:50%;
    background:rgba(53,92,90,.04);
    top:-120px;
    left:-70px;
    }
    .header:after{
    content:"";
    position:absolute;
    width:160px;
    height:160px;
    border-radius:50%;
    background:rgba(200,169,120,.08);
    right:-70px;
    bottom:-80px;
    }
    .photo{
    position:absolute;
    left:55px;
    top:35px;
    width:125px;
    height:125px;
    border-radius:50%;
    overflow:hidden;
    border:6px solid #C9A86A;
    background:#ddd;
    }
    .photo img{
    width:100%;
    height:100%;
    object-fit:cover;
    }
    .identity{
    margin-left:220px;
    padding-top:10px;
    }
    .identity h2{
    font-size:32px;
    letter-spacing:3px;
    color:#355C5A;
    font-weight:300;
    }
    .identity h1{
    font-size:58px;
    line-height:.9;
    color:#355C5A;
    margin-bottom:8px;
    font-weight:300;
    }
    .identity h4{
    font-size:18px;
    color:#777;
    font-weight:400;
    }
    .gold-line{
    margin-top:18px;
    width:140px;
    height:4px;
    background:#C9A86A;
    border-radius:50px;
    }
    /* ================= CONTENT ================= */

    table.layout{
    width:100%;
    border-collapse:collapse;
    }
    .left{
    width:30%;
    background:#067bc3;
    color:white;
    vertical-align:top;
    padding:35px;
    position:relative;
    }
    .right{
    width:70%;
    background:white;
    vertical-align:top;
    padding:35px;
    }
    /* pattern */
    .left:before{
    content:"";
    position:absolute;
    width:170px;
    height:170px;
    border-radius:50%;
    background:rgba(255,255,255,.04);
    top:-60px;
    left:-80px;
    }
    .left:after{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:rgba(255,255,255,.03);
    bottom:-90px;
    right:-120px;
    }
    .section{
    margin-bottom:32px;
    }
    .section-title{
    font-size:14px;
    letter-spacing:3px;
    font-weight:bold;
    margin-bottom:6px;
    text-transform:uppercase;
    color:#E9D8AE;
    }
    .line{
    width:55px;
    height:3px;
    background:#C9A86A;
    margin-bottom:15px;
    }
    .item{
    font-size:12px;
    line-height:1.9;
    margin-bottom:10px;
    }
    /* kanan */
    .content{
    margin-bottom:32px;
    }
    .content-title{
    font-size:17px;
    font-weight:bold;
    letter-spacing:3px;
    text-transform:uppercase;
    color:#355C5A;
    }
    .content-line{
    width:60px;
    height:3px;
    background:#C9A86A;
    margin:8px 0 15px;
    }
    .paragraph{
    font-size:13px;
    line-height:1.9;
    color:#666;
    }
    .exp{
    margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:1px solid #eee;
    }
    .exp h3{
    font-size:15px;
    color:#355C5A;
    }
    .exp small{
    color:#888;
    }
    .badge{
    display:inline-block;
    padding:5px 12px;
    border-radius:20px;
    background:#EAF4F3;
    color:#355C5A;
    font-size:11px;
    margin:4px;
    }
    .footer{
    position:absolute;
    bottom:20px;
    left:35px;
    right:35px;
    text-align:center;
    font-size:10px;
    color:#999;
    }
</style>
</head>
<body>
    <div class="cv">
        <div class="header">
            <div class="photo">
                <img  src="{{ Auth::user()?->usr_photo
                    ? asset('storage/'.Auth::user()->usr_photo)
                    : asset('assets/images/profile/user-1.jpg') }}">
            </div>
        <div class="identity">
            <h1>{{ $teacher->user->usr_name }}</h1>
            {{-- <h2>{{ $teacher->user->usr_name }}</</h2> --}}
            <h4>Guru PPLG</h4>
            <div class="gold-line"></div>
        </div>
        </div>  
    <table class="layout">
        <tr>
            <td class="left">
                <div class="section">
                    <div class="section-title">Contact</div>
                    <div class="line"></div>
                    <div class="item">
                        {{ $teacher->teacherBio->tcb_telp }}
                    </div>
                    <div class="item">
                        {{ $teacher->user->email }}
                    </div>
                    <div class="item">
                        {{ $teacher->teacherAddress->tca_regency_value }}
                    </div>
                </div>
                {{-- <div class="section">
                    <div class="section-title">Education</div>
                        <div class="line"></div>
                            <div class="item">
                                S1 Informatika
                            </div>
                            <div class="item">
                                Universitas ABC
                            </div>
                </div>
                <div class="section">
                    <div class="section-title">Skills</div>
                        <div class="line"></div>
                            <div class="item">
                                Laravel
                            </div>
                            <div class="item">
                                PHP
                            </div>
                            <div class="item">
                                MySQL
                            </div>
                            <div class="item">
                                Bootstrap
                            </div> --}}
                {{-- </div> --}}
                {{-- <div class="section">
                    <div class="section-title">Language</div>
                        <div class="line"></div>
                            <div class="item">
                                Indonesia
                            </div>
                            <div class="item">
                                English
                            </div>
                    </div> --}}
            </td>
            <td class="right">
                {{-- <div class="content">
                    <div class="content-title">
                        ABOUT ME
                    </div>
                    <div class="content-line"></div>
                    <div class="paragraph">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Suspendisse potenti. Integer vitae nisl vitae massa
                        interdum malesuada.
                    </div>
                </div> --}}

                <div class="content">
                    <div class="content-title">
                    Education
                    </div>
                    <div class="content-line"></div>
                    @forelse($teacher->teacherEducation as $edu)
                    <div class="exp">
                        <h3>
                            {{ $edu->tce_level }} - {{ $edu->tce_institution }}
                        </h3>
                        <small>
                            {{ $edu->tce_major }} Tahun Lulus {{ $edu->tce_graduation_year }}
                        </small>
                        {{-- <p class="paragraph">
                             {{ $history->tcs_subject_name }} dengan Jumlah pelajaran {{ $history->tcs_jp }} jam
                        </p> --}}
                    </div>
                    @empty

                <div class="alert alert-warning">

                    Belum ada riwayat mengajar.

                </div>

            @endforelse
            </div>

                <div class="content">
                    <div class="content-title">
                    EXPERIENCE
                    </div>
                    <div class="content-line"></div>
                    @forelse($teacher->teachHistories as $history)
                    <div class="exp">
                        <h3>
                            {{ $history->tcs_subject_name }}
                        </h3>
                        <small>
                            {{ $history->tcs_year }}
                        </small>
                        <p class="paragraph">
                            Mengajar pembelajaran {{ $history->tcs_subject_name }} dengan Jumlah pelajaran {{ $history->tcs_jp }} jam
                        </p>
                    </div>
                    @empty

                <div class="alert alert-warning">

                    Belum ada riwayat mengajar.

                </div>

            @endforelse
            </div>
            {{-- <div class="content">
                <div class="content-title">
                    CERTIFICATE
                </div>
                <div class="content-line"></div>
                <span class="badge">
                    Laravel
                </span>
                <span class="badge">
                    Flutter
                </span>
                <span class="badge">
                    UI UX
                </span>
            </div> --}}
            {{-- <div class="content">
                <div class="content-title">
                    REFERENCE
                </div>
                <div class="content-line"></div>
                <div class="paragraph">
                    Available upon request.
                </div>
            </div> --}}
            </td>
</tr>
</table>
<div class="footer">
Generated by SIPKL • 2026
</div>
</div>
</body>
</html>