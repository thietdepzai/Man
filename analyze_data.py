import json
import random
from datetime import datetime

# Giả lập dữ liệu phân tích
def run_analysis():
    # Sản phẩm mẫu
    products = {
        1: "Muối Hồng Himalaya Hạt Lớn",
        2: "Muối Biển Chấm Hoa Quả",
        3: "Muối Tiêu Đen Nguyên Hạt",
        4: "Muối Tỏi Thảo Mộc",
        5: "Muối Truffle Đen",
        6: "Muối Chanh Vàng",
        7: "Muối Khói Gỗ Sồi",
        8: "Muối Diêm Mạch"
    }

    analysis_result = {
        "last_updated": datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
        "demographics": {
            "nam_tre": {
                "desc": "Nam (18-30 tuổi)",
                "top_product_id": 7,
                "top_product_name": "Muối Khói Gỗ Sồi",
                "reason": "Thích hợp cho các buổi tiệc BBQ ngoài trời"
            },
            "nu_tre": {
                "desc": "Nữ (18-30 tuổi)",
                "top_product_id": 8,
                "top_product_name": "Muối Diêm Mạch",
                "reason": "Phù hợp chế độ ăn eat clean, healthy"
            },
            "nam_trung_nien": {
                "desc": "Nam (Trang 30+ tuổi)",
                "top_product_id": 4,
                "top_product_name": "Muối Tỏi Thảo Mộc",
                "reason": "Dùng để ướp thịt, đồ nhắm tiện lợi"
            },
            "nu_trung_nien": {
                "desc": "Nữ (Trên 30+ tuổi)",
                "top_product_id": 1,
                "top_product_name": "Muối Hồng Himalaya Hạt Lớn",
                "reason": "Quan tâm sức khoẻ, dùng nấu ăn gia đình hàng ngày"
            }
        },
        "general_stats": {
            "total_users_analyzed": random.randint(1000, 5000),
            "gender_ratio": {"nam": 45, "nu": 55},
            "age_groups": {"18-30": 60, "31-50": 30, "50+": 10}
        }
    }

    # Lưu kết quả vào public/analysis.json để Frontend và Laravel có thể đọc được
    with open('public/analysis.json', 'w', encoding='utf-8') as f:
        json.dump(analysis_result, f, ensure_ascii=False, indent=4)

    print("Data analysis complete. Results saved to public/analysis.json")

if __name__ == "__main__":
    run_analysis()
