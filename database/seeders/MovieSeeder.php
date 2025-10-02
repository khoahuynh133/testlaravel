<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('movies')->insert([
            [
                'movie_id' => 1,
                'title' => 'Tử Chiến Trên Không',
                'description' => 'Tử Chiến Trên Không lấy cảm hứng từ những vụ cướp máy bay chấn động Việt Nam thời hậu chiến. Tử Chiến Trên Không kể về Bình, một chuyên viên đào tạo Cảnh vệ Hàng không, đang trên chuyến bay đến Thành phố Hồ Chí Minh. Hành trình của anh bất ngờ rơi vào hỗn loạn, khi máy bay bị một nhóm không tặc liều lĩnh do Long cầm đầu khống chế 15 phút sau khi cất cánh. Sự chống cự kiên cường của phi hành đoàn càng khiến Long và đồng bọn thêm hung tợn, khi chúng dùng mọi thủ đoạn tàn độc để xâm nhập buồng lái và gieo rắc kinh hoàng cho hành khách. Bình phải tận dụng mưu trí và sức mạnh của mình, cùng sự hỗ trợ của các hành khách cùng phi hành đoàn can đảm để hạ gục bọn không tặc.',

                'duration' => '118',
                'release_date' => '2025-09-18',
                'poster_url' => '/assets/img/tu-chien-tren-khong/tu-chien-tren-khong-pt.jpg',
                'bg_url' => '/assets/img/tu-chien-tren-khong/tu-chien-tren-khong-bg.jpg',
                'status' => 'now_showing',
                'category' => 'Hành động, Tội phạm',
                'actor' => 'Thái Hòa, Kaity Nguyễn, Thanh Sơn, Võ Điền Gia Huy, Trần Ngọc Vàng, Lợi Trần',
                'diretor' => 'Hàm Trần',
                'country' => 'Việt Nam',
                'trailer_url' => 'https://www.youtube.com/watch?v=dasVBQuL_nA&t=2s',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'movie_id' => 2,
                'title' => 'Mưa Đỏ',
                'description' => '“Mưa Đỏ” - Phim truyện điện ảnh về đề tài chiến tranh cách mạng, kịch bản của nhà văn Chu Lai, lấy cảm hứng và hư cấu từ sự kiện 81 ngày đêm chiến đấu anh dũng, kiên cường của nhân dân và cán bộ, chiến sĩ bảo vệ Thành Cổ Quảng Trị năm 1972. Tiểu đội 1 gồm toàn những thanh niên trẻ tuổi và đầy nhiệt huyết là một trong những đơn vị chiến đấu, bám trụ tại trận địa khốc liệt này. Bộ phim là khúc tráng ca bằng hình ảnh, là nén tâm nhang tri ân và tưởng nhớ những người con đã dâng hiến tuổi thanh xuân cho đất nước, mang âm hưởng của tình yêu, tình đồng đội thiêng liêng, là khát vọng hòa bình, hoà hợp dân tộc của nhân dân Việt Nam.',

                'duration' => '124',
                'release_date' => '2025-08-21',
                'poster_url' => '/assets/img/mua-do/mua-do-pt.jpg',
                'bg_url' => '/assets/img/mua-do/mua-do-bg.jpg',
                'status' => 'now_showing',
                'category' => 'Chiến Tranh, Hành Động',
                'actor' => 'Đỗ Nhật Hoàng, Phương Nam, Lâm Thanh Nhã, Hứa Vỹ Văn',
                'diretor' => 'Đặng Thái Huyền',
                'country' => 'Việt Nam',
                'trailer_url' => 'https://www.youtube.com/watch?v=nEZcU-BZ5c4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'movie_id' => 3,
                'title' => 'Khế Ước Bán Dâu',
                'description' => 'Lấy cảm hứng từ tiểu thuyết tâm linh của nhà văn Thục Linh kể về Nhài - một cô dâu trẻ được gả vào gia tộc họ Vũ và vô tình bị cuốn vào một “khế ước” kinh hoàng với quỷ dữ. Phim mới Khế Ước Bán Dâu suất chiếu sớm 11.09 (không áp dụng Movie voucher), dự kiến khởi chiếu 12.09.2025 tại các rạp chiếu phim toàn quốc.',
                'duration' => '114',
                'release_date' => '2025-09-11',
                'poster_url' => '/assets/img/khe-uoc-co-dau/khe-uoc-co-dau-poster.jpg',
                'bg_url' => '/assets/img/khe-uoc-co-dau/khe-uoc-co-dau-bg.jpg',
                'status' => 'now_showing',
                'category' => 'Tâm Lý, Ly Kì',
                'actor' => 'Lâm Thanh Mỹ, Lãnh Thanh, NSND Trung Anh, Hữu Vĩ',
                'diretor' => 'Lê Văn Kiệt',
                'country' => 'Việt Nam',
                'trailer_url' => 'https://www.youtube.com/watch?v=5XYDm7Pj9EI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'movie_id' => 4,
                'title' => 'Huyền Thoại Rừng Xanh',
                'description' => 'Phim phiêu lưu hành động kể về nhóm nhà thám hiểm trẻ tuổi khám phá khu rừng bí ẩn chưa ai đặt chân tới. Họ phải đối mặt với thử thách thiên nhiên và sinh vật kỳ bí để tìm ra kho báu cổ xưa.',
                'duration' => '110',
                'release_date' => '2025-11-10',
                'poster_url' => '/assets/img/huyen-thoai-rung-xanh/huyen-thoai-rung-xanh-pt.jpg',
                'bg_url' => '/assets/img/huyen-thoai-rung-xanh/huyen-thoai-rung-xanh-bg.jpg',
                'status' => 'coming_soon',
                'category' => 'Phiêu Lưu, Hành Động',
                'actor' => 'Nguyễn Văn A, Trần Thị B, Lê Văn C',
                'diretor' => 'Phạm Minh Dũng',
                'country' => 'Việt Nam',
                'trailer_url' => 'https://www.youtube.com/watch?v=abc123',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'movie_id' => 5,
                'title' => 'Mắt Biếc',
                'description' => 'Một nhóm sinh viên khảo cổ tìm thấy bí mật của thành phố cổ bị chôn vùi. Hành trình khám phá dẫn họ vào những câu chuyện huyền bí, đan xen giữa hiện tại và quá khứ.',
                'duration' => '125',
                'release_date' => '2025-12-05',
                'poster_url' => '/assets/img/mat-biec/mat-biec-pt.jpg',
                'bg_url' => '/assets/img/mat-biec/mat-biec-bg.jpg',
                'status' => 'coming_soon',
                'category' => 'Tâm Lý, Ly Kỳ',
                'actor' => 'Lê Thị X, Phạm Văn Y, Trương Minh Z',
                'diretor' => 'Ngô Thanh Hùng',
                'country' => 'Việt Nam',
                'trailer_url' => 'https://www.youtube.com/watch?v=def456',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'movie_id' => 6,
                'title' => 'The Conjuring',
                'description' => 'Một nhà khoa học phát minh ra cỗ máy thời gian, đưa bản thân và đồng đội vào cuộc phiêu lưu vượt thời gian, đối mặt với những thử thách nguy hiểm để cứu thế giới.',
                'duration' => '130',
                'release_date' => '2025-12-20',
                'poster_url' => '/assets/img/the-conjuring/the-conjuring-pt.jpg',
                'bg_url' => '/assets/img/the-conjuring/the-conjuring-bg.jpg',
                'status' => 'coming_soon',
                'category' => 'Khoa Học Viễn Tưởng, Hành Động',
                'actor' => 'Nguyễn Minh T, Trần Hoàng L, Lê Thu Hà',
                'diretor' => 'Hàm Trần',
                'country' => 'Việt Nam',
                'trailer_url' => 'https://www.youtube.com/watch?v=ghi789',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
