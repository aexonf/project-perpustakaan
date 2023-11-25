import React from "react";
import { X } from "lucide-react";
import { Badge } from "@/components/ui/badge";
import { ScrollArea } from "@/components/ui/scroll-area";

export default function InfoBook({ book, setSelectedBook, setIsOpenInfo }) {
    return (
        <ScrollArea className="h-[512px] rounded-md border p-4">
            <div className="flex justify-between">
                <h3 className="text-2xl font-semibold tracking-tight">
                    Detail Buku
                </h3>
                <X
                    className="cursor-pointer"
                    onClick={() => {
                        setIsOpenInfo(false);
                        setSelectedBook(null);
                    }}
                />
            </div>
            <div className="mt-2 space-y-2">
                <div>
                    <p className="text-lg">Judul</p>
                    <h4 className="text-2xl font-semibold tracking-tight break-words">
                        {book?.title}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">Penulis</p>
                    <h4 className="text-2xl font-semibold tracking-tight">
                        {book?.writer}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">Genre</p>
                    <h4 className="text-2xl font-semibold tracking-tight">
                        {book?.genre}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">Tahun</p>
                    <h4 className="text-2xl font-semibold tracking-tight">
                        {book?.year}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">No. Inventaris</p>
                    <h4 className="text-2xl font-semibold tracking-tight">
                        {book?.no_inventory}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">Stok</p>
                    <h4 className="text-2xl font-semibold tracking-tight">
                        {book?.stock}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">Lokasi</p>
                    <h4 className="text-2xl font-semibold tracking-tight">
                        {book?.location}
                    </h4>
                </div>
                <div>
                    <p className="text-lg">Status</p>
                    {book?.status == "available" && (
                        <Badge className="text-lg px-8" variant={"success"}>
                            Tersedia
                        </Badge>
                    )}
                    {book?.status == "blank" && (
                        <Badge className="text-lg px-8" variant={"destructive"}>
                            Kosong
                        </Badge>
                    )}
                </div>
            </div>
        </ScrollArea>
    );
}
